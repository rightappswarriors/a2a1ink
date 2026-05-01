<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BladeView
{
    protected array $sections = [];
    protected string $layout = '';
    protected string $currentSection = '';

    public function extends(string $layout)
    {
        $this->layout = $layout;
    }

    public function section(string $name)
    {
        $this->currentSection = $name;
        ob_start();
    }

    public function endsection()
    {
        if (!$this->currentSection)
        {
            die('No section started');
        }

        $this->sections[$this->currentSection] = ob_get_clean();
        $this->currentSection = '';
    }

    public function yield(string $name, string $default = '')
    {
        echo isset($this->sections[$name]) ? $this->sections[$name] : $default;
    }

    public function render(string $viewPage, array $data = [])
    {
        $ci =& get_instance();
        
        // Add CI instance properties so $this->session etc. work in views
        // We use references to match CI's loader behavior
        foreach (get_object_vars($ci) as $key => $value) {
            $this->$key =& $ci->$key;
        }
        
        // Add BladeView instance as 'view' in data
        $data['view'] = $this;
        
        // Extract all data to make variables available in view
        extract($data);
        
        // Start output buffering to capture the view content
        ob_start();
        
        require __DIR__."/../views/{$viewPage}.view.php";
        
        // Get the view content
        $viewContent = ob_get_clean();
        
        // Process Blade-like directives in the view content
        $viewContent = $this->processDirectives($viewContent);
        
        // Echo the processed content
        echo $viewContent;
        
        if ($this->layout)
        {
            // For layouts, we need to process the layout similarly
            ob_start();
            require __DIR__."/../views/{$this->layout}.view.php";
            $layoutContent = ob_get_clean();
            $layoutContent = $this->processDirectives($layoutContent);
            echo $layoutContent;
        }
    }

    public function processDirectives(string $content): string
    {
        // Process @if, @elseif, @else, @endif directives
        $content = preg_replace_callback('/@if\s*\(\s*(.*?)\s*\)/', function($matches) {
            return "<?php if ({$matches[1]}) : ?>";
        }, $content);
        
        $content = preg_replace_callback('/@elseif\s*\(\s*(.*?)\s*\)/', function($matches) {
            return "<?php elseif ({$matches[1]}) : ?>";
        }, $content);
        
        $content = preg_replace('/@else/', '<?php else : ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);
        
        // Process @foreach and @endforeach directives
        $content = preg_replace_callback('/@foreach\s+\((.*?)\s+as\s+(.*?)\)/', function($matches) {
            return "<?php foreach ({$matches[1]} as {$matches[2]}) : ?>";
        }, $content);
        
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);
        
        // Process @for and @endfor directives
        $content = preg_replace_callback('/@for\s*\(\s*(.*?)\s*\)/', function($matches) {
            return "<?php for ({$matches[1]}) : ?>";
        }, $content);
        
        $content = preg_replace('/@endfor/', '<?php endfor; ?>', $content);
        
        // Process @while and @endwhile directives
        $content = preg_replace_callback('/@while\s*\(\s*(.*?)\s*\)/', function($matches) {
            return "<?php while ({$matches[1]}) : ?>";
        }, $content);
        
        $content = preg_replace('/@endwhile/', '<?php endwhile; ?>', $content);
        
        // Process @echo and {!! !!} directives (echo without escaping)
        $content = preg_replace('/\{\!\{(.*?)\}\!\}/', '<?php echo $1; ?>', $content);
        
        // Process {{ }} directives (echo with escaping)
        $content = preg_replace('/\{\{(.*?)\}\}/', '<?php echo htmlspecialchars($1, ENT_QUOTES, \'UTF-8\'); ?>', $content);
        
        // Process @php and @endphp directives
        $content = preg_replace_callback('/@php(.*?)@endphp/s', function($matches) {
            return "<?php{$matches[1]} ?>";
        }, $content);
        
        // Process @csrf directive (simplified)
        $content = str_replace('@csrf', "<input type='hidden' name='csrf_test_name' value='".get_instance()->security->get_csrf_hash()."'>", $content);
        
        return $content;
    }

    public function include(string $path, array $data = [])
    {
        // Add BladeView instance as 'view' in data for included views
        $data['view'] = $this;
        
        extract($data);
        require __DIR__."/../views/{$path}.view.php";
    }

    public static function make()
    {
        return new self;
    }
}
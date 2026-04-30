<?php $view->extends('layout/app.view'); ?>

<?php $view->section('title');?>
    Resume Form
<?php $view->endsection()?>

<?php $view->section('main-content');?>
    <form action="" method="POST">
        <div class="flex h-screen overflow-hidden">
            <?php include __DIR__ . "/../components/header.view.php"?>
            <?php include __DIR__ . "/../components/sidebar.view.php"?>

            <div class="flex-1 flex flex-col overflow-hidden bg-gray-100 mt-15 md:mt-0">
                <main class="flex-1 overflow-auto bg-gray-50 min-w-full p-4">
                    <div class="bg-gray-50 rounded-xl shadow-md max-w-4xl w-full border border-gray-200 mb-4">
                        <div class="bg-cyan-500 p-1 rounded-t-xl shadow-inner-md"></div>
                        <div class="py-2 px-6">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">Resume Generator</h2>
                            <p class="text-gray-600 text-md mb-6">Write your information below to generate your resume</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl shadow-md p-6 max-w-4xl w-full border border-gray-200">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Name and Position</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="appli_firstName" class="block text-sm font-semibold text-gray-700 mb-1">First Name<span class="text-red-500 ml-3">*</span></label>
                                <input type="text" id="appli-first-name" name="appli_firstName" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                            </div>
                            <div>
                                <label for="appli_lastName" class="block text-sm font-semibold text-gray-700 mb-1">Last Name<span class="text-red-500 ml-3">*</span></label>
                                <input type="text" id="appli-last-name" name="appli_lastName" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                            </div>
                            <div>
                                <label for="appli_posi" class="block text-sm font-semibold text-gray-700 mb-1">Position<span class="text-red-500 ml-3">*</span></label>
                                <input type="text" id="appli-posi" name="appli_posi" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl shadow-md p-6 max-w-4xl w-full border border-gray-200 mt-4">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Contact Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="appli_addre" class="block text-sm font-semibold text-gray-700 mb-1">Address<span class="text-red-500 ml-3">*</span></label>
                                <input type="text" id="appli-addre" name="appli_addre" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                            </div>
                            <div>
                                <label for="appli_email" class="block text-sm font-semibold text-gray-700 mb-1">Email<span class="text-red-500 ml-3">*</span></label>
                                <input type="email" id="appli-email" name="appli_email" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                            </div>
                            <div>
                                <label for="contct_num" class="block text-sm font-semibold text-gray-700 mb-1">Contact Number<span class="text-red-500 ml-3">*</span></label>
                                <input type="number" id="contct-num" name="contct_num" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                            </div>
                            <div>
                                <label for="appli_fb" class="block text-sm font-semibold text-gray-700 mb-1">Facebook Address</label>
                                <input type="text" id="appli-fb" name="appli_fb" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl shadow-md p-6 max-w-4xl w-full border border-gray-200 mt-4">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Skills</h2>
                        <div id="skll-container" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="skill-item mt-3 transition-all animate-fadeIn duration-300">
                                <p class="block text-sm font-semibold text-gray-700 mb-1">Skill 1<span class="text-red-500 ml-3">*</span></p>
                                <div class="flex items-center">
                                    <input type="text" name="appli_skills[]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                                    <div class="p-6"></div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group inline-block mt-6">
                            <button type="button" id="skill-btn" class="mt-5 text-sm bg-amber-400 px-3 py-2 rounded-md shadow-md focus:bg-amber-300 hover:shadow-inner hover:shadow-amber-600 transition-all duration:300">
                                Add Another<i class="fa-solid fa-plus ml-2 text-slate-500"></i>
                            </button>
                            <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs rounded-md px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 [transition-delay:300ms] pointer-events-none whitespace-nowrap shadow-md">
                                Add another skill item
                            </span>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl shadow-md p-3 max-w-4xl w-full border border-gray-200 mt-4">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 p-3">Work Expereince</h2>
                        <div id="work-exp-container">
                            <div class="work-exp-item border border-2 border-slate-300 rounded-xl p-3 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="md:col-span-2">
                                    <h3 class="text-xl text-gray-700 font-bold px-3">Item 1</h3>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company<span class="text-red-500 ml-3">*</span></label>
                                    <input type="text" id="job-company" name="work_exp[0][job_company]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Job Title<span class="text-red-500 ml-3">*</span></label>
                                    <input type="text" id="job-title" name="work_exp[0][job_title]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Job Period<span class="text-red-500 ml-3">*</span></label>
                                    <input type="text" id="job-period" name="work_exp[0][job_period]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                                </div>
                                <div class="md:col-span-2">
                                    <h3 class="text-gray-800 font-bold text-md">Job Description</h3>
                                    <div id="first-job-desc-container" class="rounded-lg border-2 border-slate-300">
                                        <div class="first-job-desc-item mt-3 ml-3 mr-3">
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Description 1<span class="text-red-500 ml-3">*</span></label>
                                            <textarea id="job-desc" name="work_exp[0][job_desc][]" rows="4" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-b-3 focus:border-cyan-500 transition duration-300 resize-vertical"></textarea>
                                        </div>
                                        <div class="first-add-jbdsc-btn-group relative group inline-block mt-6">
                                            <button type="button" id="add-job-desc-btn" class="text-sm bg-emerald-400 px-3 py-2 rounded-md shadow-md focus:bg-emerald-300 hover:shadow-inner hover:shadow-emerald-600 transition-all duration:300 mt-4">
                                                Add Another Description<i class="fa-solid fa-plus ml-2 text-slate-500"></i>
                                            </button>
                                            <span class="absolute -top-3 left-3/4 -translate-x-1/2 bg-gray-800 text-white text-xs rounded-md px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 [transition-delay:300ms] pointer-events-none whitespace-nowrap shadow-md">
                                                Add another job description for item 1
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group inline-block mt-6">
                            <button type="button" id="work-exp-btn" class="mt-5 mb-3 ml-3 text-sm bg-amber-400 px-3 py-2 rounded-md shadow-md focus:bg-amber-300 hover:shadow-inner hover:shadow-amber-600 transition-all duration:300">
                                Add Another<i class="fa-solid fa-plus ml-2 text-slate-500"></i>
                            </button>
                            <span class="absolute -top-3 left-3/4 -translate-x-1/2 bg-gray-800 text-white text-xs rounded-md px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 [transition-delay:300ms] pointer-events-none whitespace-nowrap shadow-md">
                                Add another work experience item
                            </span>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl shadow-md p-3 max-w-4xl w-full border border-gray-200 mt-4">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 p-3">Educational Background</h2>
                        <div id="sch-bg-container">
                            <div class="sch-bg-item border border-2 border-slate-300 rounded-xl p-3 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="md:col-span-2">
                                    <h3 class="text-xl text-gray-700 font-bold px-3">Item 1</h3>
                                </div>
                                <div>
                                    <label for="bach_degr" class="block text-sm font-semibold text-gray-700 mb-1">School Degree<span class="text-red-500 ml-3">*</span></label>
                                    <input type="text" id="bach-degr" name="school_bg[0][bach_degr]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                                </div>
                                <div>
                                    <label for="insti" class="block text-sm font-semibold text-gray-700 mb-1">Institution<span class="text-red-500 ml-3">*</span></label>
                                    <input type="text" id="insti" name="school_bg[0][insti]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                                </div>
                                <div>
                                    <label for="sch_year" class="block text-sm font-semibold text-gray-700 mb-1">Academic Year<span class="text-red-500 ml-3">*</span></label>
                                    <input type="text" id="sch_year" name="school_bg[0][sch_year]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                                </div>
                                <div class="md:col-span-2">
                                    <h3 class="text-gray-800 font-bold text-md">Awards<span class="text-gray-500 ml-3">(optional)</span></h3>
                                    <div id="first-sch-awards-container" class="rounded-lg border-2 border-slate-300">
                                        <div class="first-sch-awards-item mt-3 ml-3 mr-3">
                                            <label for="sch_award" class="block text-sm font-semibold text-gray-700 mb-1">Award 1</label>
                                            <textarea id="sch_award" name="school_bg[0][sch_award][]" rows="4" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-b-3 focus:border-cyan-500 transition duration-300 resize-vertical"></textarea>
                                        </div>
                                        <div class="first-sch-awrd-btn-grp relative group inline-block mt-6">
                                            <button type="button" id="first-sch-award-btn" class="text-sm bg-emerald-400 px-3 py-2 rounded-md shadow-md focus:bg-emerald-300 hover:shadow-inner hover:shadow-emerald-600 transition-all duration:300 mt-4">
                                                Add Another Award<i class="fa-solid fa-plus ml-2 text-slate-500"></i>
                                            </button>
                                            <span class="absolute -top-3 left-3/4 -translate-x-1/2 bg-gray-800 text-white text-xs rounded-md px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 [transition-delay:300ms] pointer-events-none whitespace-nowrap shadow-md">
                                                Add another award for item 1
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group inline-block mt-6">
                            <button type="button" id="edu-back" class="mt-5 mb-3 ml-3 text-sm bg-amber-400 px-3 py-2 rounded-md shadow-md focus:bg-amber-300 hover:shadow-inner hover:shadow-amber-600 transition-all duration:300">
                                Add Another<i class="fa-solid fa-plus ml-2 text-slate-500"></i>
                            </button>
                            <span class="absolute -top-3 left-3/4 -translate-x-1/2 bg-gray-800 text-white text-xs rounded-md px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 [transition-delay:300ms] pointer-events-none whitespace-nowrap shadow-md">
                                Add another education background item
                            </span>
                        </div>
                    </div>

                    <div class="block bg-gray-50 rounded-xl max-w-4xl shadow-md border border-gray-200 p-5 mt-4 mb-20">
                        <button type="submit" class="text-white bg-teal-600 px-4 py-3 rounded-lg shadow-md focus:bg-teal-500 focus:shadow-teal-500 hover:shadow-inner hover:shadow-teal-800 transition-all duration:300 mb-3">
                            <i class="fa-regular fa-floppy-disk mr-3 text-lg"></i>Save and Preview
                        </button>
                        <button type="button" id="download-form" class="text-white bg-teal-600 px-4 py-3 rounded-lg shadow-md focus:bg-teal-500 focus:shadow-teal-500 hover:shadow-inner hover:shadow-teal-800 transition-all duration:300">
                            <i class="fa-solid fa-download text-lg mr-3"></i>One-Click Download
                        </button>
                    </div>
                </main>
            </div>
        </div>
    </form>
<?php $view->endsection(); ?>

<?php $view->section('scripts');?>
    
<?php $view->endsection();?>
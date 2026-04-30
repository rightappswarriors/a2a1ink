<header class="header contain-to-grid">
	<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
				<h1><a href="<?= site_url() ?>"><b>AralLink</b> RFID System</a></h1>
			</li>
			<li class="toggle-topbar menu-icon">
				<a href="#">
					<span>Menu</span>
				</a>
			</li>
		</ul>

		<section class="top-bar-section">
			<!-- Left Nav Section -->
			<ul class="left">
				<li class="item <?= ($active_menu == 'dashboard' ? 'active' : '') ?>">
					<a href="<?= site_url() ?>">
						<span class="icon icon-dashboard"></span>
						Dashboard
					</a>
				</li>
				<li class="item <?= ($active_menu == 'devices' ? 'active' : '') ?>">
					<a href="<?= site_url("devices") ?>">
						<span class="icon icon-hdd"></span>
						Devices
					</a>
				</li>
				<li class="item <?= ($active_menu == 'consumers' ? 'active' : '') ?>">
					<a href="<?= site_url("consumers") ?>">
						<span class="icon icon-user"></span>
						Consumers
					</a>
				</li>
				<li class="item <?= ($active_menu == 'logs' ? 'active' : '') ?>">
					<a href="<?= site_url("logs") ?>">
						<span class="icon icon-calendar"></span>
						Logs
					</a>
				</li>
				<li class="item <?= ($active_menu == 'settings' ? 'active' : '') ?>" style="">
					<a href="<?= site_url("settings") ?>">
						<span class="icon icon-cog"></span>
						Settings
					</a>
				</li>
				<li class="item">
					<a href="<?= site_url("login/logout") ?>">
						<span class="icon icon-signout"></span>
						Sign-out (<?= $this->session->userdata('arallink_displayname') ?>)
					</a>
				</li>
			</ul>
		</section>
	</nav>
</header>

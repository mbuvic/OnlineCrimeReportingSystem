<style>
	.collapse a{
		text-indent:10px;
		transition: all 0.3s ease;
		padding: 1rem 1.5rem;
		color: #fff;
		opacity: 0.8;
		border-radius: 8px;
		margin: 0.2rem 0;
	}
	.collapse a:hover {
		opacity: 1;
		background: rgba(255,255,255,0.1);
		transform: translateX(5px);
	}
	.nav-item.active {
		background: rgba(255,255,255,0.1);
		border-radius: 8px;
	}
	nav#sidebar{
		background: linear-gradient(135deg, #2c3e50, #3498db);
		padding: 0.3rem;
		transition: all 0.3s ease;
	}
	.sidebar-list {
		padding: 1rem 0;
	}
	.icon-field {
		margin-right: 1rem;
		transition: all 0.3s ease;
	}
	.collapse a:hover .icon-field {
		transform: scale(1.2);
	}
	.mx-2.text-white {
		font-size: 0.8rem;
		text-transform: uppercase;
		letter-spacing: 1px;
		margin: 1.5rem 0 0.5rem 0;
		opacity: 0.6;
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Dashboard</a>
				<a href="index.php?page=complaints" class="nav-item nav-complaints"><span class='icon-field'><i class="fa fa-list-alt "></i></span> Complainants</a>
				<div class="mx-2 text-white">Master List</div>
				<a href="index.php?page=complainants" class="nav-item nav-complainants"><span class='icon-field'><i class="fa fa-user-secret "></i></span> Complainants</a>
				<a href="index.php?page=responders" class="nav-item nav-responders"><span class='icon-field'><i class="fa fa-user-shield "></i></span> Responders</a>
				<a href="index.php?page=stations" class="nav-item nav-stations"><span class='icon-field'><i class="fa fa-building "></i></span> Stations</a>
				<div class="mx-2 text-white">Report</div>
				<a href="index.php?page=complaints_report" class="nav-item nav-complaints_report"><span class='icon-field'><i class="fa fa-th-list"></i></span> Complaints Report</a>
				<div class="mx-2 text-white">Systems</div>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Users</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> System Settings</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>

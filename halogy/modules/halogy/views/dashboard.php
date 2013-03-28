<script type="text/javascript">
	var days = <?php echo $days; ?>;
</script>
<script type="text/javascript" src="<?php echo $this->config->item('staticPath'); ?>/js/jquery.flot.js"></script>
<!--[if IE]>
	<script language="javascript" type="text/javascript" src="<?php echo $this->config->item('staticPath'); ?>/js/excanvas.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo $this->config->item('staticPath'); ?>/js/jquery.flot.init.js"></script>
<script type="text/javascript">
function refresh(){
	$('div.loader').load('<?php echo site_url('/admin/activity_ajax'); ?>');
	timeoutID = setTimeout(refresh, 5000);
}
$(function(){
	timeoutID = setTimeout(refresh, 5000);
});
</script>

<div class="row">
	<div class="large-2 columns">
		<?php if (@in_array('pages', $this->permission->permissions)): ?>

			<div class="touch-box">
			
				<a href="<?php echo site_url('/admin/pages'); ?>"></a>
				<p>Manage Pages</p>
				<i class="ss-icon">list</i>
				
			</div>

		<?php endif; ?>
	</div>
	<div class="large-2 columns">
		<?php if (@in_array('pages_templates', $this->permission->permissions)): ?>

			<div class="touch-box">
			
				<p>Build Templates</p>
				<i class="ss-icon">layout</i>
				
				<a href="<?php echo site_url('/admin/pages/templates'); ?>"></a>
				
			</div>
			
		<?php endif; ?>
	</div>
	<div class="large-2 columns">
		<?php if (@in_array('images', $this->permission->permissions)): ?>

			<div class="touch-box">
			
				<p>Upload Images</p>
				<i class="ss-icon">images</i>
				
				<a href="<?php echo site_url('/admin/images'); ?>"></a>
				
			</div>
			
		<?php endif; ?>
		
	</div>
	<div class="large-2 columns">
				<?php if (@in_array('users', $this->permission->permissions)): ?>
		
			<div class="touch-box">
			
				<p>Manage Users</p>
				<i class="ss-icon">users</i>
				
				<a href="<?php echo site_url('/admin/users'); ?>"></a>
				
			</div>

		<?php endif; ?>

	</div>
	<div class="large-2 columns">
		<?php if (@in_array('blog', $this->permission->permissions)): ?>

			<div class="touch-box">
			
				<p>Blog</p>
				<i class="ss-icon">compose</i>
				
				<a href="<?php echo site_url('/admin/blog'); ?>"></a>
				
			</div>
			
		<?php endif; ?>
		
	</div>
	<div class="large-2 columns">
		<?php if (@in_array('shop', $this->permission->permissions)): ?>
			<div class="touch-box">
			
				<p>Shop</p>
				<i class="ss-icon">cart	</i>
						
				<a href="<?php echo site_url('/admin/shop'); ?>"></a>
				
			</div>
		<?php endif; ?>
		
	</div>
</div>

<div class="row">
	<div class="large-12 columns">

	</div>
</div>

<div class="row">
	
	<div class="large-8 columns">

		<div class="admin-header"><h2><?php echo ($this->session->userdata('firstName')) ? ucfirst($this->session->userdata('firstName')) : $this->session->userdata('username'); ?>'s Dashboard</h2></div>
		
		<div class="welcome">
			<?php if ($this->session->userdata('session_admin')): ?>	
				<h3>Welcome back <?php echo $this->session->userdata('username'); ?>!</h3>
				<p>Here's a few things that have been happening on your website.</p>
			<?php endif; ?>
		</div>
		
		<?php if ($errors = validation_errors()): ?>
			<div class="error">
				<?php echo $errors; ?>
			</div>
		<?php endif; ?>

		<?php if ($message): ?>
			<div class="message">
				<?php echo $message; ?>
			</div>
		<?php endif; ?>

		<ul class="dashboardnav">
			<li class="<?php echo ($days == 30) ? 'active' : ''; ?>"><a href="<?php echo site_url('/admin'); ?>">Last 30 Days</a></li>
			<li class="<?php echo ($days == 60) ? 'active' : ''; ?>"><a href="<?php echo site_url('/admin/dashboard/60'); ?>">Last 60 Days</a></li>
			<li class="<?php echo ($days == 90) ? 'active' : ''; ?>"><a href="<?php echo site_url('/admin/dashboard/90'); ?>">3 Months</a></li>
			<li><a href="<?php echo site_url('/admin/tracking'); ?>">Most Recent Visits</a></li>
		</ul>

		<div class="hide-for-touch" id="placeholder"></div>
		
		<div id="activity" class="loader">
			<?php echo $activity; ?>
		</div>

		<br class="clear" /><br />

		<?php if ($this->site->config['plan'] > 0 && $this->site->config['plan'] < 6): ?>		

			<div class="quota">
				<div class="<?php echo ($quota > $this->site->plans['storage']) ? 'over' : 'used'; ?>" style="width: <?php echo ($quota > 0) ? (floor($quota / $this->site->plans['storage'] * 100)) : 0; ?>%"><?php echo floor($quota / $this->site->plans['storage'] * 100); ?>%</div>
			</div>
			
			<p><small>You have used <strong><?php echo number_format($quota); ?>kb</strong> out of your <strong><?php echo number_format($this->site->plans['storage']); ?> KB</strong> quota.</small></p>

		<?php endif; ?>

		<br />
	
	</div>
	
	<div class="large-4 columns sidebar">
		
		<div class="panel">
			<h3>Site Info</h3>
			<ul>
				<li>Site name: <?php echo $this->site->config['siteName']; ?></li>
				<li>Site URL: <a href="<?php echo $this->site->config['siteURL']; ?>"><?php echo $this->site->config['siteURL']; ?></a></li>
				<li>Site email: <a href="mailto:<?php echo $this->site->config['siteEmail']; ?>"><?php echo $this->site->config['siteEmail']; ?></a></li>
				</ul>
		</div>
		
		<div class="panel">
			<h3>Site Stats</h3>
			<ul>
				<li>Disk space used: <?php echo number_format($quota); ?> KB</li>
				<li>Total page views: <?php echo number_format($numPageViews); ?> Views</li>
				<li>Pages: <?php echo $numPages; ?> page<?php echo ($numPages != 1) ? 's' : ''; ?></li>
				<?php if (@in_array('blog', $this->permission->permissions)): ?>
					<li>Blog posts: <?php echo $numBlogPosts ?> post<?php echo ($numBlogPosts != 1) ? 's' : ''; ?></li>
					<?php endif; ?>
			</ul>
		</div>

		<div class="panel">
			<h3>User Stats</h3>
			<ul>
				<li>Total users: <?php echo number_format($numUsers); ?> user<?php echo ($numUsers != 1) ? 's' : ''; ?></li>
				<li>New today: <?php echo number_format($numUsersToday); ?> user<?php echo ($numUsersToday != 1) ? 's' : ''; ?>
					<?php
						$difference = @round(100 / $numUsersYesterday * ($numUsersToday - $numUsersYesterday), 2);
						$polarity = ($difference < 0) ? '' : '+';
						?>						
						<?php if ($difference != 0): ?>
						(<span style="color:<?php echo ($polarity == '+') ? 'green' : 'red'; ?>"><?php echo $polarity.$difference; ?>%</span>)</li>
						<?php endif; ?>
				
					<li>New yesterday: <?php echo number_format($numUsersYesterday); ?> user<?php echo ($numUsersYesterday != 1) ? 's' : ''; ?></li>
					<li>New this week: <?php echo number_format($numUsersWeek); ?> user<?php echo ($numUsersWeek != 1) ? 's' : ''; ?>
						<?php
							$difference = @round(100 / $numUsersLastWeek * ($numUsersWeek - $numUsersLastWeek), 2);
							$polarity = ($difference < 0) ? '' : '+';
							?>				
							<?php if ($difference != 0): ?>
							(<span style="color:<?php echo ($polarity == '+') ? 'green' : 'red'; ?>"><?php echo $polarity.$difference; ?>%</span>)</li>
							<?php endif; ?>

					<li>New last week: <?php echo number_format($numUsersLastWeek); ?> user<?php echo ($numUsersLastWeek != 1) ? 's' : ''; ?></li>

			</ul>
		</div>
		
		<div class="panel">
		<h3>Most popular pages</h3>

		<?php if ($popularPages): ?>
			<ol>		
				<?php foreach ($popularPages as $page): ?>
					<li><?php echo anchor('/admin/pages/edit/'.$page['pageID'], $page['pageName']); ?></li>
				<?php endforeach; ?>
			</ol>
		<?php else: ?>
			<p>We don't have this information yet.</p>
		<?php endif; ?>
				
		<?php if (@in_array('blog', $this->permission->sitePermissions)): ?>

		<h3>Most popular blog posts</h3>

		<?php if ($popularBlogPosts): ?>
			<ol>		
				<?php foreach ($popularBlogPosts as $post): ?>
					<li><?php echo anchor('/admin/blog/edit_post/'.$post['postID'], $post['postTitle']); ?></li>
				<?php endforeach; ?>
			</ol>
		<?php else: ?>
			<p>We don't have this information yet.</p>
		<?php endif; ?>
		
		<?php endif; ?>

		<?php if (@in_array('shop', $this->permission->sitePermissions)): ?>		

		<h3>Most popular shop products</h3>

		<?php if ($popularShopProducts): ?>
			<ol>		
				<?php foreach ($popularShopProducts as $product): ?>
					<li><?php echo anchor('/admin/shop/edit_product/'.$product['productID'], $product['productName']); ?></li>
				<?php endforeach; ?>
			</ol>
		<?php else: ?>
			<p>We don't have this information yet.</p>
		<?php endif; ?>

		</div>

<?php endif; ?>
		
	</div>
	
	<br class="clear" />

</div> <!-- / row -->

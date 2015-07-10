<div id="header_wrapper">
	<?php $this->load->view('nav/navigation');?>
</div>

<div id="main-content" class="container">

	<?= isset($page_info['title']) ? "<header class='page-header'><h1>".$page_info['title']."</header></h1>" : ''; ?>
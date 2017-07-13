<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
  <div class='container-fluid'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='.navbar-collapse'>
        <span class='sr-only'>Toggle navigation</span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
      </button>
      <a class='navbar-brand' href='index.php'>CourseCode</a>
    </div>
    <div class='navbar-collapse collapse'>
      <ul class='nav navbar-nav navbar-right'>            
        <li <?php echo setActiveClass("index");?>><a href='index.php?page=1' > <?php echo translate('submitt_ass');?></a></li>
        <li <?php echo setActiveClass("crt");?>><a href='crt.php?page=1'> <?php echo translate('created_ass');?></a></li>
        <li <?php echo setActiveClass("watchlist");?>><a href='watchlist.php?page=1'> <?php echo translate('watchlist');?></a></li>
        <li <?php echo setActiveClass("messages");?>><a href="messages.php"> <?php echo translate('messages');?> <span class="badge mute"><?php echo $newMess;?></span></a></li>
        <li <?php echo setActiveClass("profile");?>><a href='profile.php'> <?php echo translate('profile');?></a></li>
        <li <?php echo setActiveClass("edit");?>><a href='edit.php'> <?php echo translate('edit_prof');?></a></li>
        <li <?php echo setActiveClass("logout");?>><a class='logout' href='logout.php'> <?php echo translate('logout');?></a></li>
      </ul>
      <form class='navbar-form navbar-right' action='search.php' method='POST'>
        <input type='text' class='form-control' name='search' placeholder=' <?php echo translate('search_ellipsis');?>'>
      </form>
    </div>
  </div>
</div>
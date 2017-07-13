<div class='col-sm-4 col-md-3 sidebare'>
  <ul class='nav nav-sidebar'>
    <li <?php echo setActiveClass("index");?>><a href='index.php?page=1'><i class="icon icon-plus"></i> <?php echo translate('submitt_ass');?></a></li>
    <?php 
      if(isActiveLink("subnew")){
        //only shown if currentpage is this
        echo '<li '. setActiveClass("subnew") .'><a href="#"><i class="icon icon-eye-open"> </i> '.translate('subm_new_ass').'</a></li>';
      }
      if(isActiveLink("view")){
        //only shown if currentpage is this
        echo '<li '. setActiveClass("view") .'><a href="#"><i class="icon icon-eye-open"> </i> '.translate('submitt_ass').'</a></li>';
      }
    ?>
    <li <?php echo setActiveClass("crt");?>><a href='crt.php?page=1'><i class="icon icon-pencil"></i> <?php echo translate('created_ass');?></a></li>
    <?php 
      if(isActiveLink("crtview")){
        //only shown if currentpage is this
        echo '<li '. setActiveClass("crtview") .'><a href="#"><i class="icon icon-eye-open"> </i> '.translate('view_crtd_ass') .'</a></li>';
      }

      if(isActiveLink("crtnew")){
        //only shown if currentpage is this
        echo '<li '. setActiveClass("crtnew") .'><a href="#"><i class="icon icon-eye-open"> </i>'.translate('crt_a_new_ass') .' </a></li>';
      }

      if(isActiveLink("assedit")){
        //only shown if currentpage is this
        echo '<li '. setActiveClass("assedit") .'><a href="#"><i class="icon icon-eye-open"> </i>'.translate('edit_ass') .'</a></li>';
      }
    ?>
    <li <?php echo setActiveClass("messages"); echo setActiveClass("messages_read");?>><a href="messages.php"><i class="fa fa-inbox"></i> <?php echo translate('messages');?> <span class="badge mute"><?php echo $newMess;?></span></a></li>
    <li <?php echo setActiveClass("watchlist");?>><a href='watchlist.php'><i class="fa fa-list-alt"></i> <?php echo translate('watchlist');?></a></li>
    <li <?php echo setActiveClass("profile");?>><a href='profile.php'><i class="fa fa-newspaper-o"></i> <?php echo translate('profile');?></a></li>
    <li <?php echo setActiveClass("edit");?> <?php echo setActiveClass("chngepass");?>><a href='edit.php'><i class="icon icon-edit"></i> <?php echo translate('edit_prof');?></a></li>
  </ul>
  <hr/>
  <ul class='nav nav-sidebar'>
    <li <?php echo setActiveClass("logout");?>><a class='logout' href='logout.php'><i class="fa fa-sign-out"> <?php echo translate('logout');?></i></a></li>
  </ul>
</div>
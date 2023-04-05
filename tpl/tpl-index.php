<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?php echo SITE_TITLE ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folder-list">
          <?php foreach($folders as $folder):?>
          <li>
            <a href="?folder_id=<?php echo $folder->id ?>"><i class="fa fa-folder"></i><?php echo $folder->name ?></a>
            <a href="?delete_folder=<?php echo $folder->id ?>"><i class="remove">x</i></a>
          </li>
          <?php endforeach; ?>

          <li class="active"> <i class="fa fa-folder"></i>Current folder</li>
        </ul>
      </div>
      <div>
          <input type="text" id="addfolderinput" placeholder="add new folder" style="width: 65%;margin-left: 7%;padding:3px">
          <button id="addfolderbtn" class="btn clickable" style="height:25px">+</button>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title">Manage Tasks</div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            <li class="checked"><i class="fa fa-check-square-o"></i><span>Update team page</span>
              <div class="info">
                <div class="button green">In progress</div><span>Complete by 25/04/2023</span>
              </div>
            </li>
            <li><i class="fa fa-square-o"></i><span>Design a new logo</span>
              <div class="info">
                <div class="button">Pending</div><span>Complete by 10/04/2022</span>
              </div>
            </li>
            <li><i class="fa fa-square-o"></i><span>Find a front end developer</span>
              <div class="info"></div>
            </li>
          </ul>
        </div>
        <div class="list">
          <div class="title">Tomorrow</div>
          <ul>
            <li><i class="fa fa-square-o"></i><span>Find front end developer</span>
              <div class="info"></div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="assets/js/script.js"></script>
  <script>
    $(document).ready(function(){
      $("#addfolderbtn").click(function(){
        var input = $("#addfolderinput");
        $.ajax({
          url:"process/ajaxhandler.php",
          method:"post",
          data: {action: "addfolder", foldername: input.val()},
          success: function(response){
            if (response == '1'){
              var folder_id = folder_id + 1;
              $('<li><a href="?folder_id= folder_id"><i class="fa fa-folder"></i>'+input.val()+'</a><a class="remove" href="?delete_folder = folder_id">x</a></li>').appendTo('.folder-list');
            }else{
              alert(response);
            }
          }
        }) //remember that this template is executing by index.php so url doesnt need to use ../ 
      });
    });
  </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?php echo SITE_TITLE ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>assets/css/style.css">
  <?php 
  if(!isset($_GET['folder_id'])){
    $_GET['folder_id'] = 0;
  }
  ?>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel">
      <a href="<?= site_url("?logout=1") ?>" onclick= "return confirm('do you want to logout?');"><i id="logout" class="fa fa-sign-out clickable"></i></a>

      <span class="username"><?= $user->name ?? 'unknown'; ?></span>
    <img src="<?= $user->image  ?>" width="40" height="40"/></div>
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

          <li class="<?= (empty($_GET['folder_id']) or isset($_GET['delete_task']) ) ? 'active':'' ?>">
          <a href="<?= site_url() ?>"><i class="fa fa-folder"></i>All</a>
          </li>

          <?php foreach($folders as $folder):?>
          <li id="folder-item" class = "<?= ($_GET['folder_id'] == $folder->id) ? 'active' : '' ?>">
            <a href="?folder_id=<?php echo $folder->id ?>"><i class="fa fa-folder"></i><?php echo $folder->name ?></a>
            <a href="?delete_folder=<?php echo $folder->id ?>" class="r1" onclick= "return confirm('are you sure to delete <?php echo $folder->name ?> folder?');"><span class="r2">x</span></a>
          </li>
          
          <?php endforeach; //as we see two anchors above have two different ways to give the folder id but both return the same thing?>

        </ul>
      </div>
      <div>
          <input type="text" id="addfolderinput" placeholder="add new folder" style="width: 65%;margin-left: 7%;padding:3px">
          <button id="addfolderbtn" class="btn clickable" style="height:25px">+</button>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title" style="width: 50%;">
          <input type="text" id="tasknameinput" placeholder="add new task (press enter)" style="width: 100%;margin-left: 3%;line-height:30px; padding-left:5px">
        </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Tasks</div>
          <ul>
          <?php if(sizeof($tasks) > 0) :?>
            <?php foreach($tasks as $task):?>
              <li class="<?= $task->is_done ? "checked" : "" ?>">
              <i data-taskid="<?= $task->id?>" class="isdone clickable <?= $task->is_done ? "fa fa-check-square-o" : "fa fa-square-o" ?>"></i>

              <span><?= $task->title ?></span>

                <div class="info">
                  <span class="created-at">Created at <?= $task->created_at ?></span>
                  <a href="?delete_task=<?= $task->id ?>" class="remove r2" onclick= "return confirm('sure to delete <?= $task->title ?>?');">x</a>
                </div>
              </li>
            <?php endforeach; ?>
          <?php else: ?>

            <li> No Task Here...</li>
           
          <?php endif; ?>

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

      $(".isdone").click(function(){
        var tid = $(this).attr("data-taskid");
        $.ajax({
            url:"process/ajaxhandler.php",
            method:"post",
            data: {action: "doneswitch",taskID: tid},
            success: function(response){
                location.reload();
            }
          });
      });


      $("#addfolderbtn").click(function(){
        var input = $("#addfolderinput");
        $.ajax({
          url:"process/ajaxhandler.php",
          method:"post",
          data: {action: "addfolder", foldername: input.val()},
          success: function(response){
            if (response == '1'){
              $('<li><a href="#"><i class="fa fa-folder"></i>'+input.val()+'</a><a class="remove" href="?delete_folder = folder_id">x</a></li>').appendTo('.folder-list');
              location.reload();
            }else{
              alert(response);
            }
          }
        }) //remember that this template is executing by index.php so url doesnt need to use ../ 
      });


      $('#tasknameinput').on('keypress',function(e){
        e.stopPropagation();
        if(e.which == 13){
          $.ajax({
            url:"process/ajaxhandler.php",
            method:"post",
            data: {action: "addtask",folderid: <?= $_GET['folder_id'] ?> ,tasktitle: $('#tasknameinput').val()},
            success: function(response){
              if (response == '1'){
                location.reload();
              }else{
                alert(response);
              }
            }
          });
        }
      });

      $('#tasknameinput').focus();
    });


  </script>

</body>
</html>

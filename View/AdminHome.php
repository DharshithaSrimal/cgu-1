<?php include_once '../Controller/UserController.php'; loadData();?>
<link rel="stylesheet" href="../res/css/staffHome.css">
<script src="../res/js/staffHome.js"></script>
<div class="container bootstrap snippets">
    <div class="row decor-default">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div id="leftCol" class="contacts-labels">
                <br>
                <h4>Welcome <?php echo unserialize($_SESSION['current_user'])->getFname() ?> !</h4>
                <br>
                <div class="pro_pic_frame" >
                    <?php echo '<img class="pro_pic" src="data:image/jpg;base64,'.base64_encode(unserialize($_SESSION['current_user'])->getImage()).'" />'; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="contacts-list">
                <a href= ""><h5 class="title">Manage Staff</h5></a>
                <a href= ""><h5 class="title">Manage Students</h5></a>
            </div>
        </div>
    </div>
</div>



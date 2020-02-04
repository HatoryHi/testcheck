<?php use application\models\Admin;

require_once(BACK_END_STYLES) ?>
<body id="page-top">

<div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><?php echo $title ?></div>
        </a>

    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <?php $getform = new Admin();
                $edit_data = $getform->getItembyId();
                ?>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                <form action="/admin/update" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id"
                               placeholder="Enter title" name="id" required value="<?php echo $edit_data[0]['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter title" name="name" required
                               value="<?php echo $edit_data[0]['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" placeholder="Enter link" name="link"
                               value="<?php echo $edit_data[0]['link'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="number" class="form-control" id="status" placeholder="Enter 0/1" name="status"
                               value="<?php echo $edit_data[0]['status'] ?>">
                        <small id="status" class="form-text text-muted">1 - visible / 0 - invisible , on default
                            0</small>
                    </div>
                    <div class="form-group">
                        <label for="position">Позиция в слайдере</label>
                        <input type="number" class="form-control" id="position" placeholder="Enter number"
                               name="position"
                               value="<?php echo $edit_data[0]['pos'] ?>">
                    </div>
                    <button name="upd" type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br>

            </div>
        </div>
        <?php include_once(FOOTER)?>
    </div>
</div>
</body>
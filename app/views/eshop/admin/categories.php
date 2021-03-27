<?php $this->view("admin/header", $data); ?>

<?php $this->view("admin/sidebar", $data); ?>

<style type="text/css">
    .add_new {
        width: 300px;
        height: 300px;
        background-color: #cecccc;
        position: absolute;
        padding: 6px;
    }

    .show {
        display: block;
    }

    .hide {
        display: none;
    }
</style>
<div class="row mt">
    <div class="col-md-12">
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Product Categories <button class="btn btn-primary btn-xs" onclick="show_add_new(event)"><i class="fa fa-plus"></i> Add New</button></h4>

                <!--add new category-->
                <div class="add_new hide"></div>


                <hr>
                <thead>
                    <tr>
                        <th><i class="fa fa-bullhorn"></i> Category</th>
                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> Description</th>
                        <th><i class="fa fa-bookmark"></i> Price</th>
                        <th><i class=" fa fa-edit"></i> Status</th>
                        <th><i class=" fa fa-edit"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="basic_table.html#">Company Ltd</a></td>
                        <td class="hidden-phone">Lorem Ipsum dolor</td>
                        <td>12000.00$ </td>
                        <td><span class="label label-info label-mini">Enabled</span></td>
                        <td>
                            <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div><!-- /content-panel -->
    </div><!-- /col-md-12 -->
</div><!-- /row -->

<script type="text/javascript">
    function show_add_new(e) {
        var show_add_box = document.querySelector(".add_new");
        if (show_add_box.classList.contains("hide")) {
            show_add_box.classList.remove("hide");
        } else {
            show_add_box.classList.add("hide");
        }
    }
</script>

<?php $this->view("admin/footer", $data); ?>
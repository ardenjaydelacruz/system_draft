<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ems/hr_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><i class="fa fa-cogs"></i> Leaves Left </li>
	</ol>
	<div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h1 class="panel-title big">Inventory Report</h1>
			</div>
			<div class="panel-body">
				<form action="<?php echo base_url();?>reports/inventory_list" role="form" method="post">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header pull-left">
                    <h4>Filter By:</h4>
                </div>
                <div class="pull-right">
                    <input type="submit" name="btnFilter" value="Filter" class="btn btn-success btn-lg">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="stocks">Category Name:</label>
                    <select name="txtCategory" id="stocks" class="form-control">
                        <?php 
                           $cat = $this->input->post('txtCategory');
                          if (!$cat){
                               echo "<option value=''>All Stocks</option>";
                           } else {
                                echo "<option value=$cat>$cat</option>";
                           }
                        ?>
                        <?php foreach ($category as $row){ 
                            echo "<option value='$row->category_name'>$row->category_name</option>";
                        } ?>
                    </select>
                </div>
            </div>
            <!-- <div class="col-sm-4">
            <label for="min">Quantity:</label>  
                <div class="row">
                  <div class="col-sm-6">
                    <input type="text" name="txtMinQuantity" id="min" placeholder="Minimum Quantity">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="txtMinQuantity" id="min" placeholder="Minimum Quantity">
                  </div>
                </div>
            </div> -->
        </div>
        </form>
        <?php if ($this->input->post('btnFilter')) { ?>
        <form action="<?php echo base_url();?>reports/inventory_list" role="form" method="post">
          <input type="hidden" name="txtCategory" value="<?php echo $this->input->post('txtCategory') ?>">
          <input type="submit" name="btnPrint" value="Print" class="btn btn-info">
        </form>
				<table class="table table-striped table-hover table-bordered table-condensed centered">
          <thead>
            <th class="text-center">Item ID</th>
            <th class="text-center">Item Name</th>
            <th class="text-center">Category</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price/pc.</th>
          </thead>
          <?php foreach ($inventory as $row) { ?>
            <tr>
              <td class="text-center">
                <?php echo $row->item_id; ?>
              </td>
              <td>
                <?php echo $row->item_name; ?>
              </td>
              <td>
                <?php echo $row->category_name; ?>
              </td>
              <td class="text-center">
                <?php echo $row->quantity; ?>
              </td>
              <td class="text-center">
                <?php echo $row->price; ?>
              </td>
              
            </tr>
            <?php } ?>
        </table>
        <?php }  ?>
			</div>
		</div>
	</div>
</div>

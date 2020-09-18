<form id="create-subcategory-form" class="form form-horizontal" action="subcategory.php" method="post" enctype="multipart/form-data">
  <input type="hidden" id="action_type" name="action_type" value="CREATE">
  <div class="box-body">

    <div class="form-group">
      <label for="category_image" class="col-sm-3 control-label">
        <?php echo sprintf(trans('label_thumbnail'),null); ?>
      </label>
      <div class="col-sm-7">
        <div class="preview-thumbnail">
          <a ng-click="POSFilemanagerModal({target:'category_image',thumb:'category_thumb'})" onClick="return false;" href="#" data-toggle="image" id="category_thumb">
            <img src="../assets/GITLanka/img/noimage.jpg" alt="">
          </a>
          <input type="hidden" name="subcategory_image" id="category_image" value="">
        </div>
      </div>
    </div>

      <div class="form-group">
        <label for="category_name" class="col-sm-3 control-label">
          <?php echo trans('label_sub_category_name'); ?><i class="required">*</i>
        </label>
        <div class="col-sm-6">
          <input ng-model="categoryName" type="text" class="form-control" id="category_name" value="" name="subcategory_name" required>
        </div>
      </div>

      <div class="form-group">
        <label for="category_slug" class="col-sm-3 control-label">
          <?php echo trans('label_sub_category_slug'); ?><i class="required">*</i>
        </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="category_slug" value="{{ categoryName | strReplace:' ':'_' | lowercase }}" name="subcategory_slug" required>
        </div>
      </div>

      <div class="form-group">
        <label for="parent_id" class="col-sm-3 control-label" id="subcategory_sex">
          <?php echo trans('label_category'); ?>
        </label>
        <div class="col-sm-6">
          <select class="form-control select2" name="category_name">
            <option value="0">
              <?php echo trans('text_select'); ?>
            </option>
            <?php foreach (get_categorys() as $the_category) { ?>
              <option value="<?php echo $the_category['category_id']; ?>"><?php echo $the_category['category_name'] ; ?></option>
            <?php } ?>
         </select>
        </div>
      </div>
      <div class="form-group">
        <label for="parent_id" class="col-sm-3 control-label">
          <?php echo trans('label_parent'); ?>
        </label>
        <div class="col-sm-6">
          <select class="form-control select2" name="parent_name">

            <option value="0">
              <?php echo trans('text_select'); ?>
            </option>
            <?php foreach (get_subcategorys() as $the_subcategory) { ?>
              <?php echo($the_subcategory); ?>
              <option value="<?php echo $the_subcategory['sub_id']; ?>"><?php echo $the_subcategory['category_name'] ; ?></option>
            <?php } ?>
         </select>
        </div>
      </div>
   

  <div class="form-group">
      <label for="category_details" class="col-sm-3 control-label">
        <?php echo trans('label_sub_category_details'); ?>
        </label>
        <div class="col-sm-6">
          <textarea class="form-control" id="category_details" name="subcategory_details"><?php echo isset($request->post['category_details']) ? $request->post['category_details'] : null; ?></textarea>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
          <button id="create-subcategory-submit" data-form="#create-subcategory-form" data-datatable="#subcategory-category-list" class="btn btn-info" name="btn_edit_category" data-loading-text="Saving...">
            <span class="fa fa-fw fa-pencil"></span>
            <?php echo trans('button_save'); ?>
          </button>
          <button type="reset" class="btn btn-danger" id="reset" name="reset"><span class="fa fa-fw fa-circle-o"></span>
            <?php echo trans('button_reset'); ?>
          </button>
        </div>
      </div>

  </div>
  <!-- end .box-body -->
</form>

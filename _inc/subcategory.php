<?php 
ob_start();
session_start();
include ("../_init.php");

// Check, if user logged in or not
// If user is not logged in then an alert message
if (!is_loggedin()) {
  header('HTTP/1.1 422 Unprocessable Entity');
  header('Content-Type: application/json; charset=UTF-8');
  echo json_encode(array('errorMsg' => trans('error_login')));
  exit();
}

// Check, if user has reading permission or not
// If user have not reading permission an alert message
if (user_group_id() != 1 && !has_permission('access', 'read_category')) {
  header('HTTP/1.1 422 Unprocessable Entity');
  header('Content-Type: application/json; charset=UTF-8');
  echo json_encode(array('errorMsg' => trans('error_read_permission')));
  exit();
}

// LOAD CATEGORY MODEL
$subcategory_model = registry()->get('loader')->model('subcategory');

// Validate post data
function validate_request_data($request) 
{
  // Validate category name
  if (!validateString($request->post['subcategory_name'])) {
    throw new Exception(trans('error_sub_category_name'));
  }

  // Validate category designation
  if (!validateString($request->post['subcategory_slug'])) {
    throw new Exception(trans('error_sub_category_slug'));
  }
   if (!isset($request->post['category_name']) || empty($request->post['category_name'])) {
    throw new Exception(trans('error_category_name'));
  }

}

function validate_existance($request, $category_id = 0)
{
  

  // Check email address, if exist or not?
  if (!empty($request->post['subcategory_slug'])) {
    $statement = db()->prepare("SELECT * FROM `sub_categorys` WHERE `category_slug` = ?");
    $statement->execute(array($request->post['subcategory_slug']));
    if ($statement->rowCount() > 0) {
      throw new Exception(trans('error_sub_category_exist'));
    }
  }
}

// Create category
if ($request->server['REQUEST_METHOD'] == 'POST' && isset($request->post['action_type']) && $request->post['action_type'] == 'CREATE'){

    try {

    // Check permission
    if (user_group_id() != 1 && !has_permission('access', 'create_subcategory')) {
      throw new Exception(trans('error_create_permission'));
    }
    
    // Validate post data
    validate_request_data($request);

    validate_existance($request);

    $Hooks->do_action('Before_Create_SubCategory', $request);

        // Insert new category into databtase
    $subcategory_id = $subcategory_model->addSubCategory($request->post);

    $Hooks->do_action('After_Create_Category', $category);

    header('Content-Type: application/json');
    echo json_encode(array('msg' => trans('text_success'), 'id' => $subcategory_id));
    exit();

    }catch (Exception $e) { 

    header('HTTP/1.1 422 Unprocessable Entity');
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(array('errorMsg' => $e->getMessage()));
    exit();
    }

}

/**
 *===================
 * START DATATABLE
 *===================
 */

$Hooks->do_action('Before_Showing_Category_List');


// DB table to use
$table = "sub_categorys";
 
// Table's primary key
$primaryKey = 'sub_id';

$columns = array(
  array(
      'db' => 'sub_id',
      'dt' => 'DT_RowId',
      'formatter' => function( $d, $row ) {
          return 'row_'.$d;
      }
  ),
  array( 'db' => 'sub_id', 'dt' => 'subcategory_id' ),
  array( 'db' => 'category_name', 'dt' => 'subcategory_name' ),
  array( 
    'db' => 'category_id',   
    'dt' => 'category_name',
    'formatter' => function($d, $row) {
      return get_category_name($row['category_id']);;
    }
  ),
  array( 'db' => 'created_at', 'dt' => 'created_at' ),
  array( 
    'db' => 'created_at',   
    'dt' => 'created_at' ,
    'formatter' => function($d, $row) {
        return $row['created_at'];
    }
  ),
  array( 'db' => 'sub_id', 'dt' => 'btn_edit' ),
  array(
    'db' => 'sub_id',
    'dt' => 'btn_edit',
    'formatter' => function( $d, $row ) {
      if (DEMO && $row['sub_id'] == 1) {          
        return'<button class="btn btn-sm btn-block btn-default" type="button" disabled><i class="fa fa-pencil"></i></button>';
      }
      return '<button id="edit-subcategory" class="btn btn-sm btn-block btn-primary" type="button" title="'.trans('button_edit').'"><i class="fa fa-fw fa-pencil"></i></button>';
    }
  ),
  array( 'db' => 'sub_id', 'dt' => 'btn_delete' ),
  array(
    'db'        => 'sub_id',
    'dt'        => 'btn_delete',
    'formatter' => function( $d, $row ) {
      if ($row['sub_id'] == 1) {
        return '<button class="btn btn-sm btn-block btn-default" type="button" disabled><i class="fa fa-fw fa-trash"></i></button>';
      }
      return '<button id="delete-category" class="btn btn-sm btn-block btn-danger" type="button" title="'.trans('button_delete').'"><i class="fa fa-fw fa-trash"></i></button>';
    }
  )
); 

echo json_encode(
    SSP::simple($request->get, $sql_details, $table, $primaryKey, $columns)
);

$Hooks->do_action('After_Showing_Category_List');

/**
 *===================
 * END DATATABLE
 *===================
 */

?>

<?php
/*
| -----------------------------------------------------
| PRODUCT NAME: 	Modern POS
| -----------------------------------------------------
| AUTHOR:			GITLanka.COM
| -----------------------------------------------------
| EMAIL:			info@GITLanka.com
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY GITLanka.COM
| -----------------------------------------------------
| WEBSITE:			http://GITLanka.com
| -----------------------------------------------------
*/

class ModelSubCategory extends Model 
{
    
    public function getCategoryName($id){
     
        $statement = $this->db->prepare("SELECT * FROM `categorys` WHERE `category_id` = ?");
        $statement->execute(array($id));
       $category = $statement->fetch(PDO::FETCH_ASSOC);
        return $category['category_name'];
       
	}
	public function getSubCategorys($data = array(), $store_id = null){
       $statement = $this->db->prepare("SELECT * FROM `sub_categorys`");
       $statement->execute();
       $subcategory = $statement->fetchAll(PDO::FETCH_ASSOC);

      return $subcategory;
   }

   public function addSubCategory($data){
     
     $statement = $this->db->prepare("INSERT INTO `sub_categorys` (category_id,category_name, category_slug, parent_id, category_details, category_image, created_at) VALUES (?, ?, ?, ?, ?, ?,?)");
       $statement->execute(array($data['category_name'],$data['subcategory_name'], $data['subcategory_slug'], $data['parent_name'], $data['subcategory_details'], $data['subcategory_image'], date_time()));

       $subcategory_id = $this->db->lastInsertId();

       return $subcategory_id;


   }

}

?>
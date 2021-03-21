<?php
class ProductModel extends Db
{
    public function getProduct($perpage,$page)
    {
        $star = ($page - 1)*$perpage;
        $sql = parent::$connection->prepare("SELECT * FROM products LIMIT $star, $perpage");
        return parent::select($sql);
    }
    //lay so luong sp
    public function getTotalRow()
    {
        $sql = parent::$connection->prepare("SELECT COUNT(product_id) FROM products ");
        return parent::select($sql)[0]['COUNT(product_id)'];
    }
     //Lấy sp theo ID
     public function getProductById($id)
     {
         $sql = parent::$connection->prepare('SELECT * FROM products WHERE product_id=?');
         $sql->bind_param('i', $id);
         return parent::select($sql)[0];
     }
     //lấy thông tin các hãng xe
     public function getCompany()
     {
         $sql = parent::$connection->prepare("SELECT * FROM company");
         return parent::select($sql);
     }
     //tìm kiếm sp hteo tên
     public function searchProduct($keyword)
    {
        $search = "%{$keyword}%";
        $sql = parent::$connection->prepare('SELECT * FROM products WHERE product_name LIKE ?');
        $sql->bind_param('s', $search);
        return parent::select($sql);
    }
       //lay so luong sp tìm kiếm
    public function getSeachTotalRow($keyword)
    {
        $search = "%{$keyword}%";
        $sql = parent::$connection->prepare('SELECT COUNT(product_id) FROM products WHERE product_name LIKE ?');
        $sql->bind_param('s', $search);
        return parent::select($sql)[0]['COUNT(product_id)'];
    }
    //Láy sp theo danh mục
    public function getProductByCategory($catId)
    {
        $sql = parent::$connection->prepare('SELECT *FROM products INNER JOIN products_category ON products.product_id = products_category.product_id WHERE products_category.category_id = ?');
        $sql->bind_param('i', $catId);
        return parent::select($sql);
    }
       //Lấy thông tin company theo ID Company
       public function getCompanyById($id)
       {
           $sql = parent::$connection->prepare('SELECT * FROM company WHERE company_id=?');
           $sql->bind_param('i', $id);
           return parent::select($sql)[0];
       }
}

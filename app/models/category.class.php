<?php

class Category
{

    public function create($DATA)
    {
        $DB = Database::getInstance();

        $arr['category'] = ucwords($DATA->data);
        if (!preg_match("/^[a-éèzA-Z ]+$/", trim($arr['category']))) {
            $_SESSION['error'] = "Entrez un nom de categorie valide";
        }

        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $query = "insert into categories (category) values (:category)";
            $check = $DB->write($query, $arr);
            if ($check) {
                return true;
            }
        }

        return false;
    }

    public function edit($DATA)
    {
    }

    public function delete($DATA)
    {
    }

    public function get_all()
    {
        $DB = Database::newInstance();
        return $DB->read("select * from categories order by id desc");
    }

    public function make_table($cats)
    {
        $result = "";
        if (is_array($cats)) {
            foreach ($cats as $cat_row) {
                $result .= "<tr>";
                $result .= '
                        <td><a href="basic_table.html#">'.$cat_row->category.'</a></td>
                        <td><span class="label label-info label-mini">'.$cat_row->disabled.'</span></td>
                        <td>
                            <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </td>
                            ';


                $result .= "</tr>";
            }
        }
        return $result;
    }
}

<?php

class Menu_model extends CI_Model
{

    public function get_menu($group_id)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('group_id',$group_id);
        $this->db->order_by('parent_id , position');
        $query = $this->db->get();
        $res = $query->result();
        if ($res){
            return $res;
        }
        else{
            return false;
        }
    }

    /**
     * Get group title
     *
     * @param int $group_id
     * @return string
     */
    public function get_menu_group_title($group_id) {
        $this->db->select('*');
        $this->db->from('menu_group');
        $this->db->where('id', $group_id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get all items in menu group table
     *
     * @return array
     */
    public function get_menu_groups() {
        $this->db->select('*');
        $this->db->from('menu_group');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_menu_group($data) {
        if ($this->db->insert('menu_group', $data)) {
            $response['status'] = 1;
            $response['id'] = $this->db->Insert_ID();
            return $response;
        } else {
            $response['status'] = 2;
            $response['msg'] = 'Add group error.';
            return $response;
        }
    }

    public function get_row($id) {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get the highest position number
     *
     * @param int $group_id
     * @return string
     */
    public function get_last_position($group_id) {
        $pos;
        $this->db->select_max('position');
        $this->db->from('menu');
        $this->db->where('group_id', $group_id);
        $this->db->where('parent_id', '0');
        $query = $this->db->get();
        $data = $query->row();
        $pos = $data->position + 1;
        return $pos;
    }

    /**
     * Recursive method
     * Get all descendant ids from current id
     * save to $this->ids
     *
     * @param int $id
     */
    public function get_descendants($id) {
        $this->db->select('id');
        $this->db->from('menu');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        $data = $query->row();

        $ids;
        if (!empty($data)) {
            foreach ($data as $v) {
                $ids[] = $v;
                $this->get_descendants($v);
            }
        }
    }

//Delete the menu
    public function delete_menu($id) {
        $this->db->where('id', $id);
        return $this->db->delete('menu');
    }

//Update MenuController Group
    public function update_menu_group($data, $id) {
        if ($this->db->update('menu_group', $data, 'id' . ' = ' . $id)) {
            return true;
        }
    }

//Delete MenuController Group
    public function delete_menu_group($id) {
        $this->db->where('id', $id);
        return $this->db->delete('menu_group');
    }

    public function delete_menus($id) {
        $this->db->where('group_id', $id);
        return $this->db->delete('menu');
    }




   public function get_label2($parentid){

        $count_menu = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->num_rows();

            $label2 = '';

            //print_r($count_menu);

            $menu2 = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->result();
            if ($count_menu > 0) {
            
                
                   
                // print_r($menu2); 

                foreach (@$menu2 as $key) {
                    //$this->get_label($key->id);

                    $label2 .= '<ol class="dd-list">
                        <li class="dd-item dd2-item" data-id="13">
                            <div class="dd-handle dd2-handle">
                                <i class="normal-icon ace-icon fa fa-comments blue bigger-130"></i>
                                
                                <input type="hidden" name="title" value="' . @$menu2->menu . '">
                                <input type="hidden" name="menu" value="' . @$menu2->id . '">
                                
                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                            </div>';

                    $label2 .='<div class="dd2-content">'.$key->menu.'212</div>';
                
                        $count_menu2 = $this->db->get_where('front_cms_menu_items',['parent_id'=>$key->id])->num_rows();
                        

                        if ($count_menu2 > 0) {
                            $this->get_label2($key->id);
                        }else{
                            
                        }
                    
                      $label2 .= '</li>
                        </ol>    
                        ';



                }

           
            }

           //s print_r($label2);
            return $label2;



    }






}

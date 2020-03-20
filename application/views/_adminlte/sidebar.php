<?php $sidebar_parent = $this->db->order_by('sidebar_index', 'asc')->where('status_id', '1')->where('sidebar_parent', '0')->get('_sidebar')->result() ?>

<?php function generate_menu($sidebar_id) {?>

    <?php $adminlte = new adminlte(); ?>
    <?php 
        $parent = get_instance()->db->order_by('sidebar_index', 'asc')->where('status_id', '1')->where('sidebar_id', $sidebar_id)->get('_sidebar')->row();
        $child = get_instance()->db->order_by('sidebar_index', 'asc')->where('status_id', '1')->where('sidebar_parent', $parent->sidebar_id)->get('_sidebar');
        $is_have_childs = $child->num_rows(); 
        $childs = $child->result(); 
    ?>

        <?php if ($is_have_childs > 0): ?>
        <!---- -->
          <li id="<?php echo $parent->sidebar_id ?>" class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon <?php echo $parent->sidebar_icon ?>"></i>
              <p>
                <?php echo $parent->sidebar_label ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <?php foreach ($childs as $var): ?>
                    <?php 
                      $adminlte->sidebar_menu_id_set($var->sidebar_id);
                      $readable = $adminlte->is_readable_menu_pages(true);
                      if ($readable) generate_menu($var->sidebar_id);
                    ?>
                <?php endforeach ?>
            </ul>
          </li>
        <!---- -->
        <?php else: ?>
          <li class="nav-item">
            <a href="<?php echo base_url($parent->sidebar_href) ?>" id="<?php echo $parent->sidebar_id ?>" class="nav-link">
              <i class="nav-icon <?php echo $parent->sidebar_icon ?>"></i>
              <p><?php echo $parent->sidebar_label ?></p>
            </a>
          </li>
        <?php endif ?>
        
<?php } ?>

<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <?php foreach ($sidebar_parent as $var): ?>
        <?php 
          $this->adminlte->sidebar_menu_id_set($var->sidebar_id);
          $readable = $this->adminlte->is_readable_menu_pages(true);
          if ($readable) generate_menu($var->sidebar_id);
        ?>
    <?php endforeach ?>

    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>

<script type="text/javascript">
  <?php $sb = $this->adminlte->sidebar_active_label_list() ?>
  <?php if (array_key_exists('child', $sb)): ?>
    $('#<?php echo $sb['child'] ?>').addClass('active');
  <?php endif ?>

  <?php if (array_key_exists('parents', $sb)): ?>
    <?php foreach ($sb['parents'] as $key => $var): ?>
      $('#<?php echo $var ?>').addClass('menu-open');
    <?php endforeach ?>
  <?php endif ?>
</script>
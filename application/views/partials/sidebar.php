<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<?php
$user = $this->session->userdata('user');
?>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">
                Balai Besar Tekstil Bandung
            </p>
        </div>
    </div>

    <ul class="app-menu">
        <?php if (($user['level'] == 'superadmin') or ($user['level'] == 'pegawai')) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-laptop"></i>

                    <span class="app-menu__label">
                        Master Data
                    </span>

                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?php echo site_url('master-data/akun'); ?>">
                            <i class="icon fa fa-circle-o"></i>
                            Akun
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item" href="<?php echo site_url('master-data/kategori'); ?>">
                            <i class="icon fa fa-circle-o"></i>
                            Kategori
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-file-text"></i>
                    <span class="app-menu__label">
                        Data
                    </span>

                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?php echo site_url('data/data-aset/aktif'); ?>">
                            <i class=" icon fa fa-circle-o"></i>
                            Data Aset Aktif
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item" href="<?php echo site_url('data/data-aset/tidak-aktif'); ?>">
                            <i class=" icon fa fa-circle-o"></i>
                            Data Aset Tidak Aktif
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-edit"></i>

                    <span class="app-menu__label">
                        Transaksi
                    </span>

                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?php echo site_url('transaksi/perolehan'); ?>">
                            <i class=" icon fa fa-circle-o"></i>
                            Perolehan
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item" href="<?php echo site_url('transaksi/penyusutan '); ?>">
                            <i class=" icon fa fa-circle-o"></i>
                            Penyusutan
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item" href="<?php echo site_url('transaksi/perbaikan'); ?>">
                            <i class=" icon fa fa-circle-o"></i>
                            Perbaikan
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item" href="<?php echo site_url('transaksi/pemberhentian'); ?>">
                            <i class=" icon fa fa-circle-o"></i>
                            Pemberhentian
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>

        <?php if (($user['level'] == 'superadmin') or ($user['level'] == 'manajemen')) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-th-list"></i>
                    <span class="app-menu__label">
                        Laporan
                    </span>

                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?php echo site_url('laporan/jurnal'); ?>">
                            <i class=" icon fa fa-circle-o"></i>
                            Jurnal
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item" href="<?php echo site_url('laporan/buku-besar'); ?>">
                            <i class=" icon fa fa-circle-o"></i>
                            Buku Besar
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item" href="<?php echo site_url('laporan/laporan-akhir-aset'); ?>">
                            <i class=" icon fa fa-circle-o"></i>
                            Laporan Akhir Aset
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
    </ul>

</aside>
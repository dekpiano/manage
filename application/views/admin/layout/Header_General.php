

                       <div class="mx-3">บริหารงานทั่วไป</div> 
                        <li class="nav-item has-submenu">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link submenu-toggle <?=$this->uri->segment('2')=="General" ? "active" :""?>"
                                href="#" data-bs-toggle="collapse" data-bs-target="#submenu-personnel" aria-expanded="false"
                                aria-controls="submenu-personnel">
                                <span class="nav-icon">
                                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">งานบุคคล</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                                <!--//submenu-arrow-->
                            </a>
                            <!--//nav-link-->
                            <div id="submenu-personnel"
                                class="collapse submenu submenu-personnel <?=$this->uri->segment('2')=="General" ? "show" :""?>"
                                data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="Personnel" ? "active" :""?>"
                                            href="<?=base_url('Admin/General/Personnel/Main');?>">จัดการบุคลากร</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!--//nav-item-->

                        <!--//nav-item-->
                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link <?=$this->uri->segment('2')=="General" && $this->uri->segment('4')=="AdminRoles" ? "active" :""?>"
                                href="<?=base_url('Admin/General/Setting/AdminRoles');?>">
                                <span class="nav-icon">
                                    <i class="bi bi-gear-fill" style="font-size: 1.2rem;"></i>
                                </span>
                                <span class="nav-link-text">จัดการบทบาทในงานทั่วไป</span>
                            </a>
                            <!--//nav-link-->
                        </li>
                   
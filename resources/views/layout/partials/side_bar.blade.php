  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
          <ul class="nav side-menu">
              @if (!empty($menus))
                  @foreach ($menus as $menu)
                      <li>
                          @if ($menu['custom_url'] == '1')
                              <a href="{{ url($menu['url']) }}"
                                  class="nav-link {{ in_array($menu['slug'], $currentUrl) ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-{{ $menu['icon'] }}"></i>
                                  <p>{{ $menu['label'] }} {!! isset($menu['children']) && count($menu['children']) > 0 ? '<i class="right fas fa-angle-left"></i>' : '' !!}
                                  </p>
                              </a>
                              @if (isset($menu['children']))
                                  @include('layouts.partials.submenu', ['menus' => $menu['children']])
                              @endif
                          @else
                              <a href="{{ route($menu['url']) }}"
                                  class="nav-link {{ in_array($menu['slug'], $currentUrl) ? 'active' : '' }}">
                                  {{-- <i class="nav-icon fas fa-{{ $menu['icon'] }}"></i> --}}
                                  <i class="fa fa-sitemap"></i>
                                  {{ $menu['label'] }}
                              </a>
                          @endif
                      </li>
                  @endforeach
              @endif
              {{-- <li>
                  <a><i class="fa fa-sitemap"></i> Management Module <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                      <li><a href="#level1_1">Management Menu</a>
                      <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                              <li class="sub_menu"><a href="level2.html">Level Two</a>
                              </li>
                              <li><a href="#level2_1">Level Two</a>
                              </li>
                              <li><a href="#level2_2">Level Two</a>
                              </li>
                          </ul>
                      </li>

                      <li><a href="#level1_2">Level One</a> </li>
                  </ul>
              </li> --}}
          </ul>
      </div>
  </div>
  <!-- /sidebar menu -->

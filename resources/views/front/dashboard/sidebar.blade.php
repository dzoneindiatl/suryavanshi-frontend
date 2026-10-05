<div class="col-md-3">
            <div class="sidebar_account_left">
              <div class="account-author">
                <div class="author_avatar">
                  <div class="image">
                    @if(!empty($user->google_id) || !empty($user->facebook_id))
                      <img src="{{ $user->profile_image }}" alt="{{ $user->name }}">
                    @elseif(!empty($user->image))
                      <img src="{{ asset('upload/users'.$user->image) }}" alt="">
                    @else    
                      <img src="{{ asset('assets/image/dummy.png') }}" alt="Avatar">
                    @endif   
                  </div>
                  <input type="file" id="fileInputDash" accept="image/*" style="display: none;">
                  <div class="btn-change_img box-icon" id="changeImgDash">
                    <i class="fa fa-camera"></i>
                  </div>
                </div>
                <h4 class="author_name">{{ $user->name }}</h4>
                <p class="author_email">{{ $user->email }}</p>
              </div>
              <ul class="my-account-nav">
                <li>
                    <a href="{{ route('user.dashboard') }}" class="my-account-nav_item"><i class="fa fa-tachometer"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('front-user.myPurchase') }}" class="my-account-nav_item"><i class="fa fa-arrow-circle-o-down"></i> Orders</a>
                </li>
                <li>
                    <a href="{{ route('front-user.wishlist') }}" class="my-account-nav_item"><i class="fa fa-heart"></i>Wishlist</a>
                </li>
                <li>
                    <a href="{{ route('front-user.address') }}" class="my-account-nav_item"><i class="fa fa-address-book-o"></i> My address</a>
                </li>
                <li>
                    <a href="{{ route('front-user.setting') }}" class="my-account-nav_item"><i class="fa fa-cog"></i> Setting</a>
                </li>
                <li>
                    <a href="{{ route('front-user.logout') }}" class="my-account-nav_item"><i class="fa fa-sign-out"></i> Log out</a>
                </li>
              </ul>
            </div>
          </div>
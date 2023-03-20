@extends('frontend.layouts.master', ['title' => 'Blogs'])

@section('main-content')

<!-- BLOG AREA START -->
<div class="ltn__blog-area mb-120">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 order-lg-2">
            <div class="ltn__blog-list-wrap">
               <!-- Blog Item -->
               @foreach ($latest_blogs as $latest_blog)
                   <div class="ltn__blog-item ltn__blog-item-5">
                     <div class="ltn__blog-img">
                        <a href="{{ route('frontend.blogs.show', $latest_blog->slug) }}">
                           <img src="{{ $latest_blog->feature_image }}" alt="Image">
                        </a>
                     </div>
                     <div class="ltn__blog-brief">
                        <div class="ltn__blog-meta">
                           <ul>
                              @foreach ($latest_blog->terms as $latest_blog_term)
                                 <li class="ltn__blog-category">
                                    <a href="{{ url()->current().'?category_id='.$latest_blog_term->id }}">{{ $latest_blog_term->name }}</a>
                                 </li>
                              @endforeach
                           </ul>
                        </div>
                        <h3 class="ltn__blog-title">
                           <a href="{{ route('frontend.blogs.show', $latest_blog->slug) }}">{{ $latest_blog->name }}</a>
                        </h3>
                        <div class="ltn__blog-meta">
                           <ul>
                              <li>
                                 <a href="javascript:void();"><i class="far fa-eye"></i>{{ $latest_blog->view_count }} Views</a>
                              </li>
                              {{-- <li>
                                 <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                              </li> --}}
                              <li class="ltn__blog-date">
                                 <i class="far fa-calendar-alt"></i>{{ $latest_blog->created_at->format('M d, Y') }} - {{ $latest_blog->created_at->diffForHumans() }}
                              </li>
                           </ul>
                        </div>
                        <p>{!! $latest_blog->abbreviatedPost !!}</p>
                        <div class="ltn__blog-meta-btn">
                           <div class="ltn__blog-meta">
                              <ul>
                                 <li class="ltn__blog-author">
                                    {{-- <a href="javascript:void();">By: {{ $latest_blog->author->name }}</a> --}}
                                    <a href="javascript:void();">By: MyanSan</a>
                                 </li>
                              </ul>
                           </div>
                           <div class="ltn__blog-btn">
                              <a href="{{ route('frontend.blogs.show', $latest_blog->slug) }}"><i class="fas fa-arrow-right"></i>Read more</a>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
               <!--  -->
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="ltn__pagination-area text-center">
                     <div class="ltn__pagination">
                        @include('frontend.layouts.shared.pagination', ['paginator' => $latest_blogs, $latest_blogs->links(), 'link_limit' => 10])
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <aside class="sidebar-area blog-sidebar ltn__right-sidebar">
               <!-- Search Widget -->
               <div class="widget ltn__search-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Search Blogs</h4>
                  <form>
                     <input type="text" name="search" value="{{ request('search') }}" placeholder="Search your keyword...">
                     <button type="submit"><i class="fas fa-search"></i></button>
                  </form>
               </div>
               <!-- Menu Widget (Category) -->
               <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Top Categories</h4>
                  <ul>
                     @foreach ($terms as $term)
                         <li>
                           <a href="{{ url()->current().'?category_id='.$term->id }}">{{ $term->name }}
                              <span>({{ $term->posts_count }})</span>
                           </a>
                        </li>
                     @endforeach
                  </ul>
               </div>
               <!-- Popular Post Widget -->
               <div class="widget ltn__popular-post-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Popular Blogs</h4>
                  <ul>
                     @foreach ($popular_blogs as $popular_blog)
                         <li>
                           <div class="popular-post-widget-item clearfix">
                              <div class="popular-post-widget-img">
                                 <a href="{{ route('frontend.blogs.show', $popular_blog->slug) }}">
                                    <img src="{{ $popular_blog->feature_image }}" alt="#">
                                 </a>
                              </div>
                              <div class="popular-post-widget-brief">
                                 <h6>
                                    <a href="{{ route('frontend.blogs.show', $popular_blog->slug) }}">
                                       {{ $popular_blog->name }}
                                    </a>
                                    </h6>
                                 <div class="ltn__blog-meta">
                                    <ul>
                                       <li class="ltn__blog-date">
                                          <a href="{{ route('frontend.blogs.show', $popular_blog->slug) }}">
                                             <i class="far fa-calendar-alt"></i>{{ $popular_blog->created_at->format('M d, Y') }}
                                          </a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </li>
                     @endforeach
                  </ul>
               </div>
               <!-- Social Media Widget -->
               <div class="widget ltn__social-media-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Follow us</h4>
                  <div class="ltn__social-media-2">
                     <ul>
                        <li>
                           <a href="{{ config('settings.social_facebook') }}" title="Facebook">
                              <i class="fab fa-facebook-f"></i>
                           </a>
                        </li>
                        <li>
                           <a href="{{ config('settings.social_twitter') }}" title="Twitter">
                              <i class="fab fa-twitter"></i>
                           </a>
                        </li>
                        <li>
                           <a href="{{ config('settings.social_linkedin') }}" title="Linkedin">
                              <i class="fab fa-linkedin"></i>
                           </a>
                        </li>
                        <li>
                           <a href="{{ config('settings.social_instagram') }}" title="Instagram">
                              <i class="fab fa-instagram"></i>
                           </a>
                        </li>

                     </ul>
                  </div>
               </div>
               <!-- Banner Widget -->
               <div class="widget ltn__banner-widget d-none">
                  <a href="shop.html"><img src="{{ asset('assets/theme/img/banner/2.jpg') }}" alt="#"></a>
               </div>

            </aside>
         </div>
      </div>
   </div>
</div>
<!-- BLOG AREA END -->
@endsection

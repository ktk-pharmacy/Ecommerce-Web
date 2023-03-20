@extends('frontend.layouts.master', ['title' => 'Blogs'])

@section('main-content')
<!-- BREADCRUMB AREA START -->
{{-- <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="{{ asset('assets/theme/img/bg/14.jpg') }}">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="ltn__breadcrumb-inner">
               <h1 class="page-title">Blog Details</h1>
               <div class="ltn__breadcrumb-list">
                  <ul>
                     <li><a href="{{ route('frontend.home') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                     <li>Blog Details</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> --}}
<!-- BREADCRUMB AREA END -->

<!-- PAGE DETAILS AREA START (blog-details) -->
<div class="ltn__page-details-area ltn__blog-details-area mb-120">
   <div class="container">
      <div class="row">
         <div class="col-lg-4">
            <aside class="sidebar-area blog-sidebar ltn__right-sidebar">
               <!-- Author Widget -->
               {{-- <div class="widget ltn__author-widget">
                  <div class="ltn__author-widget-inner text-center">
                     <img src="img/team/4.jpg" alt="Image">
                     <h5>Rosalina D. Willaimson</h5>
                     <small>Traveller/Photographer</small>
                     <div class="product-ratting">
                        <ul>
                           <li><a href="#"><i class="fas fa-star"></i></a></li>
                           <li><a href="#"><i class="fas fa-star"></i></a></li>
                           <li><a href="#"><i class="fas fa-star"></i></a></li>
                           <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                           <li><a href="#"><i class="far fa-star"></i></a></li>
                           <li class="review-total"> <a href="#"> ( 1 Reviews )</a></li>
                        </ul>
                     </div>
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis distinctio, odio, eligendi suscipit
                        reprehenderit atque.</p>
                     <div class="ltn__social-media">
                        <ul>
                           <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>

                           <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div> --}}
               <!-- Search Widget -->
               <div class="widget ltn__search-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Search Objects</h4>
                  <form action="{{ route('frontend.blogs.index') }}">
                     <input type="text" name="search" value="{{ request('search') }}" placeholder="Search your keyword...">
                     <button type="submit"><i class="fas fa-search"></i></button>
                  </form>
               </div>
               <!-- Form Widget -->
               {{-- <div class="widget ltn__form-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Drop Messege For Book</h4>
                  <form action="#">
                     <input type="text" name="yourname" placeholder="Your Name*">
                     <input type="text" name="youremail" placeholder="Your e-Mail*">
                     <textarea name="yourmessage" placeholder="Write Message..."></textarea>
                     <button type="submit" class="btn theme-btn-1">Send Messege</button>
                  </form>
               </div>
               <!-- Top Rated Product Widget -->
               <div class="widget ltn__top-rated-product-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Top Rated Product</h4>
                  <ul>
                     <li>
                        <div class="top-rated-product-item clearfix">
                           <div class="top-rated-product-img">
                              <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                           </div>
                           <div class="top-rated-product-info">
                              <div class="product-ratting">
                                 <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                 </ul>
                              </div>
                              <h6><a href="product-details.html">Luxury House In Greenville </a></h6>
                              <div class="product-price">
                                 <span>$30,000.00</span>
                                 <del>$35,000.00</del>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="top-rated-product-item clearfix">
                           <div class="top-rated-product-img">
                              <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                           </div>
                           <div class="top-rated-product-info">
                              <div class="product-ratting">
                                 <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                 </ul>
                              </div>
                              <h6><a href="product-details.html">Apartment with Subunits</a></h6>
                              <div class="product-price">
                                 <span>$30,000.00</span>
                                 <del>$35,000.00</del>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="top-rated-product-item clearfix">
                           <div class="top-rated-product-img">
                              <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                           </div>
                           <div class="top-rated-product-info">
                              <div class="product-ratting">
                                 <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                 </ul>
                              </div>
                              <h6><a href="product-details.html">3 Rooms Manhattan</a></h6>
                              <div class="product-price">
                                 <span>$30,000.00</span>
                                 <del>$35,000.00</del>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div> --}}
               <!-- Menu Widget (Category) -->
               <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Top Categories</h4>
                  <ul>
                     @foreach ($terms as $term)
                     <li>
                        <a href="{{ route('frontend.blogs.index').'?category_id='.$term->id }}">{{ $term->name }}
                           <span>({{ $term->posts_count }})</span>
                        </a>
                     </li>
                     @endforeach
                  </ul>
               </div>
               <!-- Popular Post Widget -->
               <div class="widget ltn__popular-post-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Related Blogs</h4>
                  <ul>
                     @foreach ($related_blogs as $related_blog)
                     <li>
                        <div class="popular-post-widget-item clearfix">
                           <div class="popular-post-widget-img">
                              <a href="{{ route('frontend.blogs.show', $related_blog->slug) }}">
                                 <img src="{{ $related_blog->feature_image }}" alt="#">
                              </a>
                           </div>
                           <div class="popular-post-widget-brief">
                              <h6>
                                 <a href="{{ route('frontend.blogs.show', $related_blog->slug) }}">
                                    {{ $related_blog->name }}
                                 </a>
                              </h6>
                              <div class="ltn__blog-meta">
                                 <ul>
                                    <li class="ltn__blog-date">
                                       <a href="{{ route('frontend.blogs.show', $related_blog->slug) }}">
                                          <i class="far fa-calendar-alt"></i>{{ $related_blog->created_at->format('M d, Y') }}
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
               <!-- Popular Post Widget (Twitter Post) -->
               {{-- <div class="widget ltn__popular-post-widget ltn__twitter-post-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Twitter Feeds</h4>
                  <ul>
                     <li>
                        <div class="popular-post-widget-item clearfix">
                           <div class="popular-post-widget-img">
                              <a href="blog-details.html"><i class="fab fa-twitter"></i></a>
                           </div>
                           <div class="popular-post-widget-brief">
                              <p>Carsafe - #Gutenberg ready
                                 @wordpress
                                 Theme for Car Service, Auto Parts, Car Dealer available on
                                 @website
                                 <a href="https://website.net">https://website.net</a>
                              </p>
                              <div class="ltn__blog-meta">
                                 <ul>
                                    <li class="ltn__blog-date">
                                       <a href="#"><i class="far fa-calendar-alt"></i>June 22, 2020</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="popular-post-widget-item clearfix">
                           <div class="popular-post-widget-img">
                              <a href="blog-details.html"><i class="fab fa-twitter"></i></a>
                           </div>
                           <div class="popular-post-widget-brief">
                              <p>Carsafe - #Gutenberg ready
                                 @wordpress
                                 Theme for Car Service, Auto Parts, Car Dealer available on
                                 @website
                                 <a href="https://website.net">https://website.net</a>
                              </p>
                              <div class="ltn__blog-meta">
                                 <ul>
                                    <li class="ltn__blog-date">
                                       <a href="#"><i class="far fa-calendar-alt"></i>June 22, 2020</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="popular-post-widget-item clearfix">
                           <div class="popular-post-widget-img">
                              <a href="blog-details.html"><i class="fab fa-twitter"></i></a>
                           </div>
                           <div class="popular-post-widget-brief">
                              <p>Carsafe - #Gutenberg ready
                                 @wordpress
                                 Theme for Car Service, Auto Parts, Car Dealer available on
                                 @website
                                 <a href="https://website.net">https://website.net</a>
                              </p>
                              <div class="ltn__blog-meta">
                                 <ul>
                                    <li class="ltn__blog-date">
                                       <a href="#"><i class="far fa-calendar-alt"></i>June 22, 2020</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
               <!-- Social Media Widget -->
               <div class="widget ltn__social-media-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Follow us</h4>
                  <div class="ltn__social-media-2">
                     <ul>
                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                     </ul>
                  </div>
               </div>
               <!-- Tagcloud Widget -->
               <div class="widget ltn__tagcloud-widget">
                  <h4 class="ltn__widget-title ltn__widget-title-border-2">Popular Tags</h4>
                  <ul>
                     <li><a href="#">Popular</a></li>
                     <li><a href="#">desgin</a></li>
                     <li><a href="#">ux</a></li>
                     <li><a href="#">usability</a></li>
                     <li><a href="#">develop</a></li>
                     <li><a href="#">icon</a></li>
                     <li><a href="#">Car</a></li>
                     <li><a href="#">Service</a></li>
                     <li><a href="#">Repairs</a></li>
                     <li><a href="#">Auto Parts</a></li>
                     <li><a href="#">Oil</a></li>
                     <li><a href="#">Dealer</a></li>
                     <li><a href="#">Oil Change</a></li>
                     <li><a href="#">Body Color</a></li>
                  </ul>
               </div> --}}
               <!-- Banner Widget -->
               <div class="widget ltn__banner-widget d-none">
                  <a href="shop.html"><img src="img/banner/2.jpg" alt="#"></a>
               </div>
               <!-- Instagram Widget -->
               <div class="widget ltn__instagram-widget d-none">
                  <h4 class="ltn__widget-title ltn__widget-title-border">Instagram Feeds</h4>
                  <div class="ltn__instafeed ltn__instafeed-grid insta-grid-gutter"></div>
               </div>

            </aside>
         </div>
         <div class="col-lg-8">
            <div class="ltn__blog-details-wrap">
               <div class="ltn__page-details-inner ltn__blog-details-inner">
                  <div class="ltn__blog-img">
                     <img src="{{ $blog->feature_image }}" alt="Image">
                  </div>
                  <div class="ltn__blog-meta">
                     <ul>
                        @foreach ($blog->terms as $blog_term)
                        <li class="ltn__blog-category">
                           <a href="{{ url()->current().'?category_id='.$blog_term->id }}">{{ $blog_term->name }}</a>
                        </li>
                        @endforeach
                     </ul>
                  </div>
                  <h2 class="ltn__blog-title">
                     {{ $blog->name }}
                  </h2>
                  <div class="ltn__blog-meta">
                     <ul>
                        <ul>
                           <li>
                              <a href="javascript:void();"><i class="far fa-eye"></i>{{ $blog->view_count }} Views</a>
                           </li>
                           <li class="ltn__blog-date">
                              <i class="far fa-calendar-alt"></i>{{ $blog->created_at->format('M d, Y') }} - {{
                              $blog->created_at->diffForHumans() }}
                           </li>
                           <li>
                              <a href="javascript:void();">
                                 <i class="fas fa-user-edit"></i>
                                 {{-- {{ $blog->author->name }} --}}
                                 MyanSan
                              </a>
                           </li>
                        </ul>
                     </ul>
                  </div>
                  {!! $blog->description !!}

               </div>
               <hr>
               <!-- prev-next-btn -->
               <div class="ltn__prev-next-btn row mb-50">
                  @if ($blog->previous())
                      <div class="blog-prev col-lg-6">
                        <h6>Prev Post</h6>
                        <h3 class="ltn__blog-title">
                           <a href="{{ route('frontend.blogs.show', $blog->previous()->slug) }}">
                              {{ $blog->previous()->name }}
                           </a>
                        </h3>
                     </div>
                  @endif
                 @if ($blog->next())
                     <div class="blog-prev blog-next text-right text-end col-lg-6">
                        <h6>Next Post</h6>
                        <h3 class="ltn__blog-title">
                           <a href="{{ route('frontend.blogs.show', $blog->next()->slug) }}">
                              {{ $blog->next()->name }}
                           </a>
                        </h3>
                     </div>
                 @endif
               </div>
               <hr>
               <!-- related-post -->
               {{-- <div class="related-post-area mb-50">
                  <h4 class="title-2">Related Post</h4>
                  <div class="row">
                     <div class="col-md-6">
                        <!-- Blog Item -->
                        <div class="ltn__blog-item ltn__blog-item-6">
                           <div class="ltn__blog-img">
                              <a href="blog-details.html"><img src="img/blog/blog-details/11.jpg" alt="Image"></a>
                           </div>
                           <div class="ltn__blog-brief">
                              <div class="ltn__blog-meta">
                                 <ul>
                                    <li class="ltn__blog-date ltn__secondary-color">
                                       <i class="far fa-calendar-alt"></i>June 22, 2020
                                    </li>
                                 </ul>
                              </div>
                              <h3 class="ltn__blog-title"><a href="blog-details.html">A series of iOS 7 inspire
                                    vector icons sense.</a></h3>
                              <p>Lorem ipsum dolor sit amet, conse ctet ur adipisicing elit, sed doing.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <!-- Blog Item -->
                        <div class="ltn__blog-item ltn__blog-item-6">
                           <div class="ltn__blog-img">
                              <a href="blog-details.html"><img src="img/blog/blog-details/12.jpg" alt="Image"></a>
                           </div>
                           <div class="ltn__blog-brief">
                              <div class="ltn__blog-meta">
                                 <ul>
                                    <li class="ltn__blog-date ltn__secondary-color">
                                       <i class="far fa-calendar-alt"></i>June 22, 2020
                                    </li>
                                 </ul>
                              </div>
                              <h3 class="ltn__blog-title"><a href="blog-details.html">A series of iOS 7 inspire
                                    vector icons sense.</a></h3>
                              <p>Lorem ipsum dolor sit amet, conse ctet ur adipisicing elit, sed doing.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- comment-area -->
               <div class="ltn__comment-area mb-50">
                  <div class="ltn-author-introducing clearfix">
                     <div class="author-img">
                        <img src="img/blog/author.jpg" alt="Author Image">
                     </div>
                     <div class="author-info">
                        <h6>Written by</h6>
                        <h2>Rosalina D. William</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                           dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation is enougn for today.</p>
                     </div>
                  </div>
                  <h4 class="title-2">03 Comments</h4>
                  <div class="ltn__comment-inner">
                     <ul>
                        <li>
                           <div class="ltn__comment-item clearfix">
                              <div class="ltn__commenter-img">
                                 <img src="img/testimonial/1.jpg" alt="Image">
                              </div>
                              <div class="ltn__commenter-comment">
                                 <h6><a href="#">Adam Smit</a></h6>
                                 <span class="comment-date">20th May 2020</span>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste
                                    magnam ratione.</p>
                                 <a href="#" class="ltn__comment-reply-btn"><i class="icon-reply-1"></i>Reply</a>
                              </div>
                           </div>
                           <ul>
                              <li>
                                 <div class="ltn__comment-item clearfix">
                                    <div class="ltn__commenter-img">
                                       <img src="img/testimonial/3.jpg" alt="Image">
                                    </div>
                                    <div class="ltn__commenter-comment">
                                       <h6><a href="#">Adam Smit</a></h6>
                                       <span class="comment-date">21th May 2020</span>
                                       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit
                                          corporis iste magnam ratione.</p>
                                       <a href="#" class="ltn__comment-reply-btn"><i class="icon-reply-1"></i>Reply</a>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </li>
                        <li>
                           <div class="ltn__comment-item clearfix">
                              <div class="ltn__commenter-img">
                                 <img src="img/testimonial/4.jpg" alt="Image">
                              </div>
                              <div class="ltn__commenter-comment">
                                 <h6><a href="#">Adam Smit</a></h6>
                                 <span class="comment-date">25th May 2020</span>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste
                                    magnam ratione.</p>
                                 <a href="#" class="ltn__comment-reply-btn"><i class="icon-reply-1"></i>Reply</a>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <hr>
               <!-- comment-reply -->
               <div class="ltn__comment-reply-area ltn__form-box mb-60---">
                  <h4 class="title-2">Post Comment</h4>
                  <form action="#">
                     <div class="input-item input-item-textarea ltn__custom-icon">
                        <textarea placeholder="Type your comments...."></textarea>
                     </div>
                     <div class="input-item input-item-name ltn__custom-icon">
                        <input type="text" placeholder="Type your name....">
                     </div>
                     <div class="input-item input-item-email ltn__custom-icon">
                        <input type="email" placeholder="Type your email....">
                     </div>
                     <div class="input-item input-item-website ltn__custom-icon">
                        <input type="text" name="website" placeholder="Type your website....">
                     </div>
                     <label class="mb-0 input-info-save"><input type="checkbox" name="agree"> Save my name, email, and website in
                        this browser for the next time I comment.</label>
                     <div class="btn-wrapper">
                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit"><i class="far fa-comments"></i>
                           Post Comment</button>
                     </div>
                  </form>
               </div> --}}
            </div>
         </div>

      </div>
   </div>
</div>
<!-- PAGE DETAILS AREA END -->
@endsection

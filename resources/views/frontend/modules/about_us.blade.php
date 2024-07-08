@extends('frontend.layouts.master')

@section('page_title', $title)

@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h2>{{ $sub_title }}</h2>
                            <h4>{{ $title }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('contents')

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <p class="lead">Welcome to <strong>Blog Project Site</strong>!</p>
            <p>At <strong>Blog Project Site</strong>, we are passionate about <em>technology, lifestyle, and
                    self-improvement</em>. Our mission is to provide insightful, engaging, and valuable content to our
                readers, helping them stay informed and inspired.</p>
            <br>
            <hr>
            <h3>Who We Are</h3>
            <p>We are a team of dedicated writers, researchers, and enthusiasts who are committed to delivering high-quality
                articles and blog posts. Each member of our team brings unique perspectives and expertise, ensuring that our
                content is diverse and well-rounded.</p>
            <br>
            <h3>What We Offer</h3>
            <br>
            <ul>
                <li><strong>In-Depth Articles</strong>: Our blog features comprehensive articles on a wide range of topics
                    within our niche. We strive to cover all angles and provide in-depth analysis and insights.</li>
                <li><strong>How-To Guides</strong>: We offer practical how-to guides and tutorials to help you navigate
                    various aspects of technology, lifestyle, and personal development.</li>
                <li><strong>Latest Trends</strong>: Stay updated with the latest trends and developments in our niche. We
                    keep our finger on the pulse of the industry to bring you the most current information.</li>
                <li><strong>Personal Stories</strong>: Read personal stories and experiences from our team and guest
                    contributors. These narratives offer a personal touch and relatable content for our readers.</li>
            </ul>
            <br>
            <h3>Our Values</h3>
            <br>
            <ul>
                <li><strong>Quality</strong>: We are committed to providing high-quality content that is well-researched,
                    accurate, and informative.</li>
                <li><strong>Integrity</strong>: We believe in honesty and transparency in all our content. Our readers trust
                    us to provide reliable information.</li>
                <li><strong>Community</strong>: We value our readers and strive to create a community where everyone feels
                    welcome and engaged. We encourage feedback, comments, and discussions.</li>
            </ul>
            <br>
            <hr>
            <h3>Join Us</h3>
            <p>We invite you to join us on this journey of exploration and learning. Whether you are here to gain knowledge,
                find inspiration, or simply enjoy some great reads, we are glad to have you with us.</p>
            <p>Feel free to explore our blog, leave comments, and share our posts with your friends and family. Your support
                and engagement mean the world to us.</p>
            <p>Thank you for visiting <strong>Blog Project Site</strong>. We hope you enjoy your time here!</p>

            <p class="text-end">Warm regards,<br>The <strong>Blog Project Site</strong> Team</p>
        </div>
    </div>

@endsection

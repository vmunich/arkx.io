@extends('layouts.app')

@section('content')
    <div class="xxs:page-home-wrapper-xxs xs:page-home-wrapper-xs sm:page-home-wrapper-sm md:page-home-wrapper-md lg:page-home-wrapper-lg xl:page-home-wrapper-xl">
        @include('shared.home-header')

        <div class="homepage p-6 pb-0">
            <h2 class="mb-3">Introduction</h2>
            <p class="mb-6">This is ArkX, a Community Driven Delegate, and I’m a self-taught developer with over 10 years of experience as a Full-Stack Developer working with web, mobile and desktop applications in my day to day work.</p>
            <p class="mb-6">I’m always pushing forward by using the newest cutting-edge technologies and techniques, resulting in experimental projects on the side such as software prototyping in the field of Internet of Things.</p>

            <h2 class="mb-3">Skill set</h2>
            <p class="mb-6">My everyday work revolves around PHP, Laravel and VueJS for the back-end with some sprinkles of Ruby every now and then. When it comes to the front-end I work with HTML5, CSS3, ES6 and Webpack to make life easier. To make sure everything is working I utilize PHPUnit, PHPSpec, Behat and Jest.</p>
            <p class="mb-6">The database work will be done with PostgreSQL as MySQL is very error prone when working with sensitive data and big numbers. All server related tasks are done with Linux & Docker for fast setups that get staged before deploying to the live realm.</p>

            <h2 class="mb-3">Goals</h2>
            <p class="mb-6">The goal of this delegate is to provide voters with a fair profit share while also funding the development and maintenance of existing and new projects for the Ark Ecosystem to equip developers with the tools they need to build applications that make use of Ark.</p>

            <h2 class="mb-3">Contributons</h2>
            <p class="mb-6">I have been contributing to the Ark Ecosystem since Summer 2017 but actions speak louder then words so here is a <a href="{{ route('contributions') }}">list of contributions</a>.</p>

            <h2 class="mb-3">Features</h2>
            <p>I want to give you, the voter, full control over your earnings and wallets so I've implemented the following features to make this possible.</p>
            <ul class="info-list mt-3 mb-6">
                <li>Custom Disbursement Intervals <strong>There are several benefits to choosing a different interval then the default</strong></li>
                <li>Manage Wallets <strong>Holding a lot of ARK split between wallets? Claim all your wallets and managed them under one account</strong></li>
                <li>Disbursement Notifications <strong>Receive on-site notifications when a disbursement occured. No more noise via e-mail</strong></li>
                <li>Change E-Mail address <strong>Moving on to a new e-mail provider? Let us know and we will update it</strong></li>
                <li>Change Password <strong>Chose a weak password? Change it to a stronger one and we will encrypt & securely store it</strong></li>
                <li>Two-Factor Authentication <strong>Want an extra layer of security? Just enable 2FA with the Google Authenticator</strong></li>
            </ul>

            <h2 class="mb-3">Profit Sharing</h2>
            <p class="mb-3 italic">We do cover transaction fees for everyone and perform daily payouts at midnight, UTC.</p>

            <ul class="info-list">
                <li>80% <strong>Profit Share split up between Voters</strong></li>
                <li>20% <strong>Maintain and Develop Ark Community Projects, the ArkX Ecosystem and support the ACF with monthly donations</strong></li>
            </ul>
        </div>
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection

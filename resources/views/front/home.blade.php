@extends('layouts.app')

@section('content')
    <div class="xxs:page-home-wrapper-xxs xs:page-home-wrapper-xs sm:page-home-wrapper-sm md:page-home-wrapper-md lg:page-home-wrapper-lg xl:page-home-wrapper-xl">
        @include('shared.home-header')

        <div class="homepage">
            <div class="xxs:page-home-xxs xs:page-home-xs sm:page-home-sm md:page-home-md lg:page-home-lg xl:page-home-xl">
                <div class="balance-tracking">
                    <div class="media">
                        <img src="/images/arkx_tracking.png" />
                    </div>

                    <div class="content">
                        <h2>Balance tracking</h2>
                        <p>
                            Each user has the ability to know their earnings and track it
                            in real time and more.
                        </p>
                        <p>
                            The goal of this delegate is to provide voters with a fair profit share
                            while also funding the development and maintenance of existing and
                            new project for the Ark Ecosystem.
                        </p>
                    </div>
                </div>

                <div class="customization">
                    <div class="content">
                        <h2>Automated Disbursements</h2>
                        <p>
                            Each voter for ArkX is eligible to fair and regular disbursements that are automated to prevent any delays.
                        </p>
                        <p>
                            <span>You can customize disbursement for every wallet individually from day to year. By default disbursement will be done on a daily basis but there are benefits for switching!</span>
                        </p>
                    </div>

                    <div class="media">
                        <img src="/images/arkx_customization.png" />
                    </div>
                </div>

                <div class="calculator">
                    <div class="content">
                        <h2>Daily Earnings Calculator</h2>
                        <p>
                            Right now you can find out an estimated earnings you can get if you vote for ArkX.
                            Insert the amount of ARK you hold and immediately see the result.
                        </p>
                    </div>

                    <div class="media">
                        <ProfitCalculator
                            :pool="{{ cache('delegate.votes') }}"
                            :share="{{ config('ark.share.percentage') }}" />
                    </div>
                </div>

                <div class="servers">
                    <div class="content">
                        <h2>Stable rewards<br class="sm:hidden" /> with stable servers</h2>
                        <p>
                            The backup node will automatically boot if the main node is unavailable
                            which takes a minute. If that fails we will be notified within minutes
                            via Slack, Mail, and SMS that something is wrong so that we can take action.
                        </p>
                    </div>

                    <div class="media">
                        <img src="/images/arkx_server_xxs.png" />
                        <img src="/images/arkx_servers.png" />
                    </div>

                    <div class="content2">
                        <h2>Stable rewards<br class="xxs:hidden xl:block" /> with stable servers</h2>
                        <p>
                            The backup node will automatically boot if the main node is unavailable
                            which takes a minute. If that fails we will be notified within minutes
                            via Slack, Mail, and SMS that something is wrong so that we can take action.
                        </p>
                    </div>
                </div>

                <div class="footer">
                    <p>&copy; ArkX 2017 - {{ date('Y') }}. All rights reserved. Version: <em>{{ $appVersion }}</em></p>

                    <p>
                        <a href="https://github.com/ArkEcosystem/laravel"><i class="fab fa-laravel"></i></a>
                        <a href="https://github.com/faustbrian"><i class="fab fa-git"></i></a>
                        <a href="https://arkecosystem.slack.com/"><i class="fab fa-slack-hash"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection

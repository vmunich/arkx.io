@extends('layouts.app')

@section('content')
    <div class="xxs:page-home-wrapper-xxs xs:page-home-wrapper-xs sm:page-home-wrapper-sm md:page-home-wrapper-md lg:page-home-wrapper-lg xl:page-home-wrapper-xl">
        @include('shared.home-header')

        <div class="homepage p-6 pb-0">
            <h2 class="mb-3">Core 2.0 Contributons</h2>
            <p>Since December 2017 I have been a <a href="https://github.com/ArkEcosystem/core/graphs/contributors">major contributor <span class="italic">(#1)</span> to Ark Core 2.0</a> where I took on several tasks that had a major impact on shaping the product to what it is now.</p>
            <ul class="info-list mb-6">
                <li><a target="_blank" href="#">Application Architecture</a> <strong>Planned & Executed several major architectural refactors for Core 2.0</strong></li>
                <li><a target="_blank" href="#">Design & Implementation of the Public API</a> <strong>Designed & Implemented the Public API with <a href="https://hapijs.com/">hapi.js</a></strong></li>
                <li><a target="_blank" href="#">Design & Implementation of the Webhooks</a> <strong>Designed & Implemented the Webhooks and Webhooks API with <a href="https://hapijs.com/">hapi.js</a></strong></li>
                <li><a target="_blank" href="#">Design & Implementation of the Plugin System</a> <strong>Designed & Implemented the Plugin System to allow developers deeper integrations</strong></li>
                <li><a target="_blank" href="#">Refactor of the Database Layer</a> <strong>Refactored the database layer to use <a href="https://github.com/vitaly-t/pg-promise">pg-promise</a> instead of <a href="http://docs.sequelizejs.com/">Sequelize</a> to provide better performance and optimisation capabilities</strong></li>
                <li><a target="_blank" href="#">Refactor of the P2P API</a> <strong>Refactored the P2P API to use <a href="https://hapijs.com/">hapi.js</a> and improved the general architecture</strong></li>
                <li><a target="_blank" href="#">Initial Test Suite</a> <strong>Laid the groundwork & implemented the initial test-suite and utilities to make testing easier</strong></li>
                <li><a target="_blank" href="#">General Overlooking of Tasks & Continuous Refactoring</a> <strong>Overlooked the general development, tasks & provided help and advice when needed</strong></li>
                <li><a target="_blank" href="#">Identifying & Solving structucal issues</a> <strong>Identified and solved critical structural issues several times during development</strong></li>
            </ul>

            <h2 class="mb-3">Community Contributons</h2>
            <p>I have been contributing to the Ark Ecosystem since Summer 2017 but actions speak louder then words so here is a list of contributions.</p>
            <ul class="info-list mt-3 mb-6">
                <li><a target="_blank" href="https://docs.ark.io/docs/clients-guidelines">API Client Guidelines</a> <strong>A standardized guide about how to API client packages</strong></li>
                <li><a target="_blank" href="https://docs.ark.io/docs/cryptography-guidelines">Cryptography Guidelines</a> <strong>A standardized guide about how to building cyptography packages</strong></li>
                <li><a target="_blank" href="https://docs.ark.io/docs/repository-management">Development Guidelines</a> <strong>A standardized guide about how to conduct development & project management</strong></li>
                <li><a target="_blank" href="https://docs.ark.io/docs/development">Core 2.0 Documentation</a> <strong>A few pages that provide insights into Ark Core 2.0</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/core-commander">Core Commander</a> <strong>Developed from scratch in Q2 2018 - Replacing <em class="font-normal">ArkEcosystem/ARKcommander</em></strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/explorer">Explorer 3.0</a> <strong>Developed from scratch in Q1 2018</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/json-rpc">JSON-RPC</a> <strong>Developed from scratch in Q2 2018 - Replacing <em class="font-normal">ArkEcosystem/rpc-server</em></strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/crypto-fixture-generator">Ark Crypto Fixture Generator</a> <strong>Developed from scratch in Q3 2018</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/go-client">Go Client</a> <strong>Developed from scratch in Q3 2018 - Replacing <em class="font-normal">ArkEcosystem/ark-go</em></strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/go-crypto">Go Crypto</a> <strong>Developed from scratch in Q3 2018 - Replacing <em class="font-normal">ArkEcosystem/ark-go</em></strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/java-client">Java Client</a> <strong>Developed from scratch in Q3 2018</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/java-crypto">Java Crypto</a> <strong>Developed from scratch in Q3 2018</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/dotnet-client">.NET Client</a> <strong>Developed from scratch in Q3 2018 - Replacing <em class="font-normal">ArkEcosystem/ark-net</em></strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/dotnet-crypto">.NET Crypto</a> <strong>Developed from scratch in Q3 2018 - Replacing <em class="font-normal">ArkEcosystem/ark-net</em></strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/elixir-client">Elixir Client</a> <strong>Refactored & Adapted <em class="font-normal">faustbrian/ark-elixir</em> as an official package</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/elixir-crypto">Elixir Crypto</a> <strong>Refactored & Adapted <em class="font-normal">faustbrian/ark-elixir</em> as an official package</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/php-client">PHP Client</a> <strong>Refactored & Adapted <em class="font-normal">faustbrian/ark-php</em> as an official package</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/php-crypto">PHP Crypto</a> <strong>Refactored & Adapted <em class="font-normal">faustbrian/ark-php</em> as an official package</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/ruby-client">Ruby Client</a> <strong>Refactored & Adapted <em class="font-normal">faustbrian/ark-ruby</em> as an official package</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/ruby-crypto">Ruby Crypto</a> <strong>Refactored & Adapted <em class="font-normal">faustbrian/ark-ruby</em> as an official package</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/laravel">Laravel</a> <strong>Refactored & Adapted <em class="font-normal">faustbrian/ark-laravel</em> as an official package</strong></li>
                <li><a target="_blank" href="https://github.com/ArkEcosystem/symfony">Symfony</a> <strong>Refactored & Adapted <em class="font-normal">faustbrian/ark-symfony</em> as an official package</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/noah">noah</a> <strong>Automated Rebuilds for <em class="font-normal">ArkEcosystem/ark-node</em></strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/moses">moses</a> <strong>Automated Snapshots for <em class="font-normal">ArkEcosystem/ark-node</em></strong></li>
                <li><a target="_blank" href="https://arkcommunity.fund/">Ark Community Fund</a> <strong>Developed the Ark Community Fund Website after joining the board in November 2017</strong></li>
            </ul>

            <h2 class="mb-3">Projects</h2>
            <ul class="info-list mt-3">
                <li><a target="_blank" href="https://github.com/faustbrian/ark-calculus">Ark Calculus</a> <strong>Simple TBW & Profit Share Calculator for PHP</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/ark-eloquent">Ark Eloquent</a> <strong>An ARK Blockchain bridge for Laravel Eloquent</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/ark-qr-code-vue">Ark QR Code Vue</a> <strong>A Vue.js component to generate QR codes for Ark payments</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-airbrake">Core Airbrake</a> <strong>Airbrake error tracker integration for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-bugsnag">Core Bugsnag</a> <strong>Bugsnag error tracker integration for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-delegate-api">Core Delegate API</a> <strong>A delegate experience focused API for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-elasticsearch">Core Elasticsearch</a> <strong>An Elasticsearch integration for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-logger-pino">Core Logger Pino</a> <strong>Pino logger integration for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-logger-signale">Core Logger Signale</a> <strong>Signale logger integration for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-logger-winston3">Core Logger Winston3</a> <strong>Winston 3.0 logger integration for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-payroll">Core Payroll</a> <strong>True Block Weight & Disbursements for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-raygun">Core Raygun</a> <strong>Raygun error tracker integration for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-rollbar">Core Rollbar</a> <strong>Rollbar error tracker integration for Ark Core</strong></li>
                <li><a target="_blank" href="https://github.com/faustbrian/core-sentry">Core Sentry</a> <strong>Sentry error tracker integration for Ark Core</strong></li>
            </ul>
        </div>
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection

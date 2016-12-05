
window._ = require('lodash');

/**
 * モーダルやタブのような基本的なBootstrap機能をサポートしている
 * jQueryとBootstrap jQueryプラグインをロードします。このコードは
 * アプリケーション独自の必要に応じて、変更されることになります。
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

require('admin-lte');
window.toastr = require('toastr');
require('icheck');

/**
 * VueはモダンなJavaScriptライブラリで、リアクティブなデータ結合と
 * 再利用可能なコンポーネントを使用し、インタラクティブなWebインターフェイスを構築できます。
 * VueのAPIはクリーンかつシンプルで、次の素晴らしいプロジェクト構築へ集中させてくれます。
 */

window.Vue = require('vue');
require('vue-resource');

/**
 * このアプリケーションから外へ向けて送る各リクエストへヘッダに、
 * "CSRF"ヘッダを付けるため、HTTPインターセプタを登録します。Laravelに
 * 含まれるCSRFヘッダが自動的に、ヘッダ中の値の正当性を調べます。
 */

Vue.http.interceptors.push((request, next) => {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;

    next();
});

/**
 * Echoはチャンネルを購入したり、Laravelによりブロードキャストされるイベントをリスニング
 * するための、記述的なAPIを提供しています。Echoとイベントブロードキャストにより、
 * あなたのチームは堅牢なリアルタイムWebアプリを簡単に構築できるでしょう。
 */

// "laravel-echo"からEchoをインポート

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

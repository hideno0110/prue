
/**
 * VueとVueリソースを含めた、このプロジェクトの全Javascriptの依存を
 * 最初にロードします。これはVueとLaravelを使用する、堅牢でパワフルな
 * アプリケーション構築の素晴らしいスタート地点となるでしょう。
 */

require('./bootstrap');

/**
 * 次に、真新しいVueアプリケーションのインスタンスを生成し、
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

import Vue from 'vue';
import VueRouter from 'vue-router';
import './bootstrap';
// apollo
import ApolloClient from 'apollo-boost';  // DO NOT USE {} !!!! mofo
import VueApollo from 'vue-apollo';
// components
import Post from './Post';
import PostList from './PostList';
import TopicPostList from './TopicPostList';
import AuthorPostList from './AuthorPostList';
import NotFound from './NotFound'

window.Vue = Vue;
Vue.use(VueRouter);

// define routes
const routes = [
  {
    path: '/',
    name: 'index',  // can use as redirect; super, so don't have to remember the path; especially for multilingual
    component: PostList
  },
  {
    path: '/post/:id', // passing param; it is required
    name: 'post',
    component: Post
  },
  {
    path: '/topics/:slug',
    name: 'topic',
    component: TopicPostList
  },
  {
    path: '/authors/:id',
    name: 'author',
    component: AuthorPostList
  },
  {
    path: '*',
    name: '404',
    component: NotFound    
  }
];

// use apollo as plugin:
Vue.use(VueApollo);

// install Apollo client for Vue
const apolloClient = new ApolloClient({
  // this must change to dev server and later to production server
  uri: 'http://127.0.0.1:8000/graphql'
});

// create Apollo provider
const apolloProvider = new VueApollo({
  defaultClient: apolloClient
});

// create the router
const router = new VueRouter({
  mode:'history',
  routes
});

import moment from 'moment';
// define filters
Vue.filter("timeago", value => moment(value).fromNow());
Vue.filter("longDate", value => moment(value).format('MMMM Do YYYY'));

const app = new Vue({
    el: '#app',
    apolloProvider,
    router,  // passing the router to app
});

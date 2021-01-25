<template>
  <div class="container mx-auto px-4 w-full md:w-3/4 lg:w-3/5 xl:w-1/2 my-20">
    <h2 class="text-4xl" >All Posts</h2>
    <div v-if="$apollo.queries.posts.loading">Loading Data</div>
    <PostListItem v-for="post in posts" :key="post.id" :post="post" class="mt-10">{{ post.title }}</PostListItem>
  </div>
</template>

<script>
import gql from "graphql-tag";  // it is a function; it creates a tagged template
import PostListItem from './components/PostListItem';

export default {
  components: {
   PostListItem
  },
  apollo: {
    posts: gql`
      {
        posts {
          id
          title
          lead
          created_at
            author {
              id
              name
            }
            topic {
              name
              slug
            }          
        }
      }
    `
  }
};

// tagged template gets converted to a AST (Abstract Syntax Tree) first
// can omit query keyword
</script>
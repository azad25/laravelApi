<template>
    <div>
        <h2>Posts</h2>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" tabindex="-1" @click="fetchArticles(pagination.prev_page_url)">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" tabindex="-1" @click="fetchArticles(pagination.next_page_url)">Next</a>
                </li>
            </ul>
        </nav>
        <div v-for="article in articles" v-bind:key="article.id">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ article.title }}</h5>
                    <p class="card-text">{{ article.body }}</p>
                    <hr>
                    <button @click="deleteArticle(article.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    <button @click="editArticle(article.id)" class="btn btn-success"><i class="fas fa-edit"></i></button>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" tabindex="-1" @click="fetchArticles(pagination.prev_page_url)">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" tabindex="-1" @click="fetchArticles(pagination.next_page_url)">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
  data(){
    return {
      articles: [],
      article: {
        id: '',
        title: '',
        body: ''
      },
      article_id: '',
      pagination:{},
      eidt: false
    }
  },

  created(){
    this.fetchArticles();
  },

  methods: {
    fetchArticles(page_url){
        let vm = this;
        page_url = page_url || '/api/articles'
        fetch(page_url)
          .then(res => res.json())
          .then(res => {
            this.articles = res.data;  
            vm.makePagination(res.meta, res.links);
          })
          .catch(err => console.log(err));
    },
    makePagination(meta, links){
        let pagination = {
            current_page: meta.current_page,
            last_page: meta.last_page,
            next_page_url: links.next,
            prev_page_url: links.prev
        }

        this.pagination = pagination;
    },
    deleteArticle(id){
        if(confirm('Are you Sure?')){
            fetch(`api/article/${id}`, {
                method: 'delete'
            })
            .then(res => res.json())
            .then(data => {
                if(data.ok == 1){
                    alert('Article removed');
                    this.fetchArticles();
                }
            })
            .catch(err=> console.log(err));
        }
    }
  }
}
</script>

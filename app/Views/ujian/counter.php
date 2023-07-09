<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
<h2>Counter</h2>
<p>{{ count }}</p><button @click="increment">Increment</button>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script defer>
    const AppComponent = {
        data() {
            return {}
        },
        methods: {
            test() { }
        }
    }
</script>
<?= $this->endSection() ?>
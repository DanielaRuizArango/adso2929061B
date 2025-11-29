<script>
    const btnSelect = document.querySelector('.btn-select')
    btnSelect.addEventListener('click', e => {
        document.querySelector('input[type=file]').click()
    })
</script>
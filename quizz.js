<script>
function toggle_quizz(quizz_id) {
    var quizz = document.getElementById('quizz' + quizz_id);
    if (quizz.style.display === 'none') {
        quizz.style.display = 'block';
    } else {
        quizz.style.display = 'none';
    }
}
</script>
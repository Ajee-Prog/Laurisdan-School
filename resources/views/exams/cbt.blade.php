<h4>Time Remaining: <span id="timer"></span></h4>

<form method="POST" action="{{ route('exam.submit') }}" id="examForm">
    @csrf
    <input type="hidden" name="exam_id" value="{{ $exam->id }}">

    <!-- QUESTIONS HERE -->

    <button class="btn btn-success">Submit Exam</button>
</form>

<script>
let endTime = new Date("{{ $result->started_at->addMinutes($exam->duration) }}").getTime();

let timer = setInterval(function () {
    let now = new Date().getTime();
    let distance = endTime - now;

    if (distance <= 0) {
        clearInterval(timer);
        alert("Time up! Exam submitted.");
        document.getElementById('examForm').submit();
    }

    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s";
}, 1000);
</script>
@extends('layouts.myadmin')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review</title>
  <link rel="stylesheet" href="/style_review.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <div>
    <h1>รีวิว</h1>

    @if($reviews->isEmpty())
    <p class="text-center">ยังไม่มีข้อมูลรีวิว</p>
    @else

    
    @foreach($parties as $partyId => $partyReviews)
      <div class="col col-lg-4">
        <div class="card">
          <h5 class="card-title">{{ $partyReviews->first()->party->party_name }}</h5>
          <small class="text-muted">ค่าเฉลี่ยคะแนน: {{ number_format($avg_ratings[$partyId]->average_rating, 2) }}/5</small>
        </div>
        <!-- ปุ่มแสดงป๊อปอัพข้อมูลการรีวิว -->
        <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $partyId }}">
          ข้อมูลการรีวิว
        </button>

        <!-- Modal ข้อมูลการรีวิว -->
        <div class="modal fade" id="reviewModal{{ $partyId }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $partyId }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel{{ $partyId }}"> {{ $partyReviews->first()->party->party_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                @foreach($partyReviews as $review)
                <div class="card mb-3">
                  <div class="card-body">
                    <h5 class="card-title">{{ $review->user->username }}</h5>
                    <p class="card-subtitle text-muted">{{ $review->user->email }}</p>
                    <strong>วันที่รีวิว :</strong> {{ date('d F', strtotime($review->created_at)) }} {{ date('Y', strtotime($review->created_at)) + 543 }}
                    <p class="card-text"><strong>รีวิว :</strong>{{ $review->review }}</p>
                    <p class="card-text"><strong>คะแนน :</strong> {{ $review->rating }}/5</p>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
@endsection

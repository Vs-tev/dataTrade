{{-- <div {{ $attributes->merge(['class'=> 'ml-5']) }} >
<h1>{{$title}}</h1>
<h1>{{$info}}</h1>
    Hello this is a card
    <ul>
    @foreach ($list('vasko') as $item)
        <li>{{$item}}</li>
    @endforeach
    </ul>

    {{$slot}} this allow content inside card to be schown 
</div> --}}



  <p>hasdjhak</p>
    <div {{$attributes->merge(['class' => 'card bg-light'])}}  style="width:400px">
      <h2>{{$sss}}</h2>
      <img class="card-img-top" src="https://loremflickr.com/320/240/paris,girl/all" alt="Card image" style="width:100%">
      <div class="card-body">
        <h4 {{ $attributes->merge(['class'=> 'card-title'])}}>{{$cardname}}</h4>
        <p {{$attributes->merge(['class'=> 'text-muted'])}}>{{$cardtext}}</p>
        <a href="#" class="btn btn-danger stretched-link">{{$button}}</a>
      </div>
    </div>
    {{$slot}}
  
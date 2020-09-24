@extends('layouts.sample')

@section('title', 'フォロー一覧')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              @foreach ($all_users as $user)
                  <div class="card">
                      <div class="card-haeder p-3 w-100 d-flex">
                          <img src="{{ $user->icon_img }}" class="rounded-circle" width="50" height="50">
                          <div class="ml-2 d-flex flex-column">
                              <p class="mb-0">{{ $user->name }}</p>
                              <p class="mb-1">ID. {{ $user->id }}</p>
                              <p class="mb-1">{{ $user->introduction }}</p>
                          </div>
                          @if (auth()->user()->isFollowed($user->id))
                              <div class="px-2">
                                  <span class="px-1 bg-secondary text-light">フォローされています</span>
                              </div>
                          @endif
                          <div class="d-flex justify-content-end flex-grow-1">
                            {{-- dd(auth()->user()->isFollowing($user->id)) --}}
                              @if (auth()->user()->isFollowed($user->id))
                                  <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                      {{ csrf_field() }}
                                      {{ method_field('DELETE') }}

                                      <button type="submit" class="btn btn-danger">フォロー解除</button>
                                  </form>
                              @else
                                  <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                      {{ csrf_field() }}

                                      <button type="submit" class="btn btn-primary">フォローする</button>
                                  </form>
                              @endif
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
      <div class="my-4 d-flex justify-content-center">
          {{ $all_users->links() }}
      </div>
  </div>
@endsection
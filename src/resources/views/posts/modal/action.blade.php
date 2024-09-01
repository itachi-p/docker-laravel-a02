<!-- 元のページからモーダルとして表示させる為に、このページをincludeした上で
    idの先頭に#を付け、ページ内遷移と同様に<a href="#delete-post-x(ポストID)">の形で指定する -->
<div class="modal fade" id="delete-post-{{ $post->id }}">
    <div class="modal-dialog">
        <!-- Card形式（Header-Body-Footer)でモーダルを表示 [https://getbootstrap.jp/docs/5.3/components/modal/] -->
        <div class="modal-content border-danger"> <!-- モーダル全体の枠 -->

            {{-- Header --}}
            <div class="modal-header border-danger">
                <div class="h5 modal-title text-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> Delete Post
                </div>
            </div>
            {{-- Body --}}
            <div class="modal-body">
                <p class="lead text-warning">Are you sure you want to delete this post?</p>
                <div class="mt-3">
                    <!-- ここの画像のサイズ調整はBootstrapでなく、カスタムCSSによって行うこともできる -->
                    <!-- カスタムCSSファイルを別途用意するより、class="w-100" と指定した方が手間が少ない気はする -->
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="image-sm w-100">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>
            {{-- Footer --}}
            <div class="modal-footer border-0">
                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                    <!-- このモーダルの中でDBに対するDELETEを実行するので、元のposts/indexページ内の method('DELETE')は消す -->
                    <!-- 消さなかった場合、実際はモーダルで削除確認画面が表示される前に削除が実行されてしまう（要確認）-->
                    @csrf
                    @method('DELETE')

                    <!-- この data-bs-dissmiss によりキャンセルボタン押下時は何もせずモーダルを閉じ、元のページに戻る -->
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <!-- ワンクッション置いた上での削除実行 -->
                    <!-- 元の画面の削除ボタンはただモーダルを呼び出すトリガーとしてのみ働くように変更(削除の実行は保留にする) -->
                    <!-- PostControllerのdestroyメソッドや、routes/web.phpは何も変える必要はない。 -->
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
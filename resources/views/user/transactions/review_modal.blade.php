    @foreach ($orders as $order)
            @if (
                ( $order->status_order === 'completed') &&
                    optional($order->transaction)->status === 'verified')
                    {{-- update --}}
                @if ($order->review)
                    <div class="modal fade" id="editReviewModal-{{ $order->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white shadow-lg">
                                <form action="{{ route('reviews.update', $order->review->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="modal-title fw-bold">Edit Ulasan
                                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p class="text-center text-muted mb-2">Ubah penilaian Anda:</p>
                                        {{-- mengisi bintang yang ada pada database  --}}
                                        <div class="rating mb-3">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" name="rating" value="{{ $i }}"
                                                    id="edit-{{ $i }}-{{ $order->id }}"
                                                    {{ $order->review->rating == $i ? 'checked' : '' }}>
                                                <label for="edit-{{ $i }}-{{ $order->id }}">☆</label>
                                            @endfor
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Komentar</label>
                                            <textarea class="form-control" name="comment" rows="3">{{ $order->review->comment }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Ganti Foto (Opsional)</label>
                                            @if ($order->review->proof)
                                                <div class="mb-2">
                                                    <img src="{{ asset($order->review->proof) }}" alt="Bukti"
                                                        class="img-thumbnail" style="height: 80px;">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="proof" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="modal-footer border-0 pt-0">
                                        <button type="button" class="btn btn-secondary rounded-pill"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit"
                                            class="btn btn-warning text-white rounded-pill px-4">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Create --}}
                @else
                    <div class="modal fade" id="reviewModal-{{ $order->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white shadow-lg">
                                <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="modal-title fw-bold">Ulas Pesanan
                                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- Bintang --}}
                                        <p class="text-center text-muted mb-2">Bagaimana pengalaman pesanan Anda?</p>
                                        <div class="rating mb-3">
                                            <input type="radio" name="rating" value="5"
                                                id="5-{{ $order->id }}" required><label
                                                for="5-{{ $order->id }}">☆</label>
                                            <input type="radio" name="rating" value="4"
                                                id="4-{{ $order->id }}"><label for="4-{{ $order->id }}">☆</label>
                                            <input type="radio" name="rating" value="3"
                                                id="3-{{ $order->id }}"><label for="3-{{ $order->id }}">☆</label>
                                            <input type="radio" name="rating" value="2"
                                                id="2-{{ $order->id }}"><label for="2-{{ $order->id }}">☆</label>
                                            <input type="radio" name="rating" value="1"
                                                id="1-{{ $order->id }}"><label for="1-{{ $order->id }}">☆</label>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Komentar (Opsional)</label>
                                            <textarea class="form-control" name="comment" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Foto Bukti (Opsional)</label>
                                            <input type="file" class="form-control" name="proof" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 pt-0">
                                        <button type="button" class="btn btn-secondary rounded-pill"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach

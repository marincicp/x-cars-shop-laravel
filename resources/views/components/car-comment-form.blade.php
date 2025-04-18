 <div class="w-full">
     <x-form.form method="POST" action="{{ route('comment.store', $car) }}">
         <div class="form-content">
             <div class="col ">
                 <x-form.input name="comment" placeholder="Leave a comment..." marginB />

                 <div class="flex justify-between ">
                     <div class=" mb-medium">
                         <button class="btn btn-primary btn-submit">Comment</button>
                     </div>


                 </div>
             </div>
         </div>
     </x-form.form>
 </div>

   <x-app-layout>


       <main>
           <!-- New Cars -->
           <section>
               <div class="container">
                   <div Class="flex justify-between items-center">
                       <h2>My Favourite Cars</h2>
                       @if ($cars->total() > 0)
                           <div class="pagination-summary">
                               <p>

                                   Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }} of {{ $cars->total() }}
                                   results.
                               </p>
                           </div>
                       @endif
                   </div>
                   <div class="car-items-listing">
                       @forelse ($cars as $car)
                           <x-car-item :$car isInWatchList />
                       @empty

                           <p class=" card text-center  grid-span-1-3 p-medium">You don't have any favorite
                               cars yet.</p>
                       @endforelse

                   </div>

                   {{ $cars->onEachSide(1)->links() }}
               </div>
           </section>
           <!--/ New Cars -->
       </main>
   </x-app-layout>

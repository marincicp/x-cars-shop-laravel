<x-app-layout>
    <main>
        <x-alert />

        <div class="container">
            <div class="card p-large my-large">
                <h2>Verify Your Email Address</h2>
                <div class="my-medium">
                    Before proceeding, please check your email for a
                    verification link. If you did not receive the email,
                    <form method="POST" action="{{ route('verification.send') }}" class="inline-flex">
                        @csrf
                        <button type="submit" class="btn-link">
                            click here to request another
                        </button>
                        .
                    </form>
                </div>

                <div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary ">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>

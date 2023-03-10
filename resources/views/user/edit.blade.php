@include('blog.include.header')
            <main class="content">
				<div class="container">
                    <div class="title"><h1>Edit User</h1></div>
                    <br>
                    {{-- Edit User --}}
                            <form action="{{ 'update/'.$id }}" method="post" enctype="multipart/form-data"> 
                                @csrf
                            <!-- Modal body -->
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input class="form-control" type="text" name="name"  placeholder="Name" value="{{ $name }}"><br>
                                <input class="form-control" type="email" name="email"  placeholder="Email" value="{{ $email }}" ><br>
                                {{-- <input class="form-control" type="text" name="role"  placeholder="Job Role" value="{{ $role }}" ><br> --}}
                                <div>
                                  <select name="role" id="role">
                                    <option value="Admin">Admin</option>  
                                    <option value="Subscriber">Subscriber</option>  
                                  </select>
                                </div><br>
                                <input class="form-control" type="file" name="profile" value="{{ $profile }}"><br>
                           
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>


			</main>

@include('blog.include.footer')
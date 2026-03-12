<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
       
        </h2>
    </x-slot>
    <div class="personnel-form">

      <div class="personnel-form">

        <form action="" method="POST">
            @csrf

            <select name="branch_name" id="">
                <option value="oten_branch">Hello Branch</option>
                <option value="sige_branch">Hello Branch</option>
            </select>
            
            <select name="branch_department" id="">
                <option value="it_department">IT DEPARTMENT</option>
                <option value="hr_department">HR DEPARTMENT</option>
            </select>
            <input type="text" name="personnel_name">
            
            <button type="submit">SUBMIT PO</button>

        </form>
        @if(session('success'))
            <p>{{session('success')}}</p>
        @endif
</div>
    </div>
</x-app-layout>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Quizzer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" charset="utf-8"></script>
    <style media="screen">

      :root{
        --bg-0: #0b1320;
        --bg-1: #363d4c;
        --bg-2: #1c3f60;
        --bg-3: #0088cc;

        --color-0: #ffffff;
        --color-1: #effaff;
        --color-2: #d3d3d3;
      }

      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: cursive;
      }

      /* width */
      ::-webkit-scrollbar {
        width: 8px;
      }

      /* Track */
      ::-webkit-scrollbar-track {
        background: var(--bg-0);
        border-radius: 8px;
      }

      /* Handle */
      ::-webkit-scrollbar-thumb {
        background: var(--color-2);
        border-radius: 8px;
      }

      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
        background: var(--color-1);
      }

      body{
        min-height: 100vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        background: var(--bg-0);
        color: var(--color-2);
      }

      header{
        background: var(--bg-1);
        color: var(--color-0);
        display: flex;
        flex-direction: column;
        position: fixed;
        width: 100%;
      }
      header .two{
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 3rem;
      }

      a{
        text-decoration: none;
      }
      button, .btn{
        padding: 0.5rem 1.2rem;
        font-size: 1em;
        cursor: pointer;
        border-radius: 5px;
        border: none;
        outline: none;
        transition: all .2s ease-in;
      }
      .btn-primary{
        background: var(--bg-3);
        color: var(--color-0);
      }
      .btn-primary:hover{
        filter: brightness(90%) saturate(90%);
      }
      .btn-secondary{
        padding: 0.35rem 1rem;
        border: 2px solid var(--bg-3);
        color: var(--color-0);
      }
      .btn-secondary:hover{
        background-color: var(--bg-3);
      }
      main{
        flex: 1;
        display: flex;
        padding: 1rem;
        flex-direction: column;
        margin-top: 60px;
        overflow-y: auto;
      }

      .links{
        display: flex;
        gap: 1rem;
        align-items: center;
      }
      .link{
        color: var(--bg-3);
      }
      .link:hover{
        text-decoration: underline;
      }

      .note{
        padding: 0.25rem 0.5rem;
        width: 100%;
        position: relative;
        top: 0;
        left: 0;
        right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .error{
        color: #D8000C;
			  background-color: #FFBABA;
      }

      .info{
        color: #00529B;
  			background-color: #BDE5F8;
      }
      .success{
        color: #4F8A10;
			  background-color: #DFF2BF;
      }

      .login-form{
        display: flex;
        flex-direction: column;
        gap: 1rem;
        min-width: 300px;
        padding: 2rem;
        border-radius: 8px;
        border: 2px solid var(--bg-1);
      }

      .date{
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .input-field{
        display: flex;
        flex-direction: column;
      }

      input:not(input[type="submit"]){
        padding: 0.75rem;
        font-size: 1em;
        background: var(--bg-1);
        color: var(--color-2);
        outline: none;
        border: 1px solid var(--bg-0);
        border-radius: 5px;

      }

      input:not(input[type="submit"]):focus{
        border-color: var(--bg-3);
      }
      .user-container{
        padding: 0 5rem;
        display: flex;
        flex-direction: column;
      }

      .user-container{
        margin-top: 1rem;
        width: 100%;
        height: 100%;
      }
      .form-container{
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        justify-content: center;
      }
      .exam-container{
        margin-top: 1rem;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .styled-table {
          border-collapse: collapse;
          margin: 25px 0;
          font-size: 0.9em;
          font-family: sans-serif;
          min-width: 400px;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }

      .styled-table thead tr th:last-of-type,
      .styled-table tbody tr td:last-of-type{
        /* width: 260px; */
        text-align: center;
      }

      .styled-table tbody tr td:last-of-type{
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.5em;
      }
      .styled-table tr{
        border-radius: 5px;
      }

      .styled-table thead tr {
          background-color: var(--bg-3);
          color: #ffffff;
          text-align: left;
      }
      .styled-table th,
      .styled-table td {
          padding: 12px 15px;
      }
      .styled-table tbody tr {
          border-bottom: 3px solid var(--bg-0);
      }

      .styled-table tbody tr{
          background-color: var(--bg-1);
      }
      .role{
        display: flex;
        width: 100%;
        gap: 1rem;
        align-items: center;
        justify-content: center;
      }
      option, select{
        padding: 0.5rem 1rem;
        border-radius: 5px;
        border: 1px solid var(--bg-0);
      }
      select{
        flex: 1;
        background: var(--bg-1);
        color: var(--color-1);

      }
      select:focus{
        border-color: var(--bg-3);
      }

    </style>
  </head>
  <body>

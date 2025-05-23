const loadBooksByRestButton = document.getElementById( 'bookstore-load-books' );
if ( loadBooksByRestButton ){
    loadBooksByRestButton.addEventListener( 'click', function() {
        const allBooks = new wp.api.collections.Books();
        allBooks.fetch().done(
            function ( books ) {
                const textarea = document.getElementById( 'bookstore-booklist' );
                books.forEach ( function (book) {
                    textarea.value += book.title.rendered + ',' + book.link + ',\n';
                } )
            }
        )
    } );
}

const fetchBooksByRestButton = document.getElementById( 'bookstore-fetch-books' );
if ( fetchBooksByRestButton ){
    fetchBooksByRestButton.addEventListener( 'click', function() {
        wp.apiFetch( { path: '/wp/v2/books' } ).then(
            ( books ) => {
                const textarea = document.getElementById( 'bookstore-booklist' );
                books.map(
                    ( book ) => {
                        textarea.value += book.title.rendered + ',' + book.link + ',\n';
                    }
                )
            }
        )
    } );
}

function submitBook() {
    const title = document.getElementById( 'bookstore-book-title' ).value;
    const content = document.getElementById( 'bookstore-book-content' ).value;

    // if (!bookstoreSettings.nonce) {
    //     console.error('Nonce is missing');
    //     return;
    // }

    wp.apiFetch( {
        path: '/wp/v2/books/',
        method: 'POST',
        // headers: {
        //     'X-WP-Nonce': bookstoreSettings.nonce
        // },
        data: {
            title: title,
            content: content,
            status: "publish"
        },
    } ).then((result) => {
        console.log(result);
        // alert('Book saved!');
    }).catch((error) => {
        console.error('Error:', error);
        alert('Failed to save book: ' + error.message);
    });
}

function updateBook(id) {
    const title = document.getElementById( 'bookstore-book-title' ).value;
    const content = document.getElementById( 'bookstore-book-content' ).value;
    wp.apiFetch( {
        path: '/wp/v2/books/' + id,
        method: 'POST',
        data: {
            title: title,
            content: content
        },
    } ).then( ( result ) => {
        alert( 'Book updated!' );
    } );
}

function deleteBook(id) {
    const title = document.getElementById( 'bookstore-book-title' ).value;
    const content = document.getElementById( 'bookstore-book-content' ).value;
    wp.apiFetch( {
        path: '/wp/v2/books/' + id,
        method: 'DELETE',

    } ).then( ( result ) => {
        alert( 'Book deleted!' );
    } );
}

const submitBookButton = document.getElementById( 'bookstore-submit-book' );
if ( submitBookButton ) {
    submitBookButton.addEventListener( 'click', submitBook );
}
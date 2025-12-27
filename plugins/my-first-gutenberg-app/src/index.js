import {Button, Modal, SearchControl, SnackbarList, Spinner} from '@wordpress/components';
import { useState, createRoot } from '@wordpress/element';
import {useDispatch, useSelect} from '@wordpress/data';
import { store as coreDataStore } from '@wordpress/core-data';
import { decodeEntities } from '@wordpress/html-entities';
import { store as noticesStore } from '@wordpress/notices';

import { EditPageButton } from "./edit";
import { CreatePageButton } from "./create";
import {DeletePageButton} from "./delete";

function MyFirstApp() {
    const [ searchTerm, setSearchTerm ] = useState( '' );

    const { pages, hasResolved } = useSelect(
        ( select ) => {
            const query = {};
            if ( searchTerm ) {
                query.search = searchTerm;
            }
            const selectorArgs = [ 'postType', 'page', query ];
            return {
                pages: select( coreDataStore ).getEntityRecords( ...selectorArgs ),
                hasResolved:
                    select( coreDataStore ).hasFinishedResolution( 'getEntityRecords', selectorArgs ),
            }
        },
        [ searchTerm ]
    );

    return (
        <div>
            <div className="list-controls">
                <SearchControl
                    value={ searchTerm }
                    onChange={ setSearchTerm }
                />
                <CreatePageButton />
            </div>
            <PagesList hasResolved={ hasResolved } pages={ pages }/>
            <Notifications />
        </div>
    );
}

function PagesList( { hasResolved, pages } ) {
    if ( !hasResolved ) {
        return <Spinner/>
    }
    if ( !pages?.length ) {
        return <div>No results</div>
    }

    return (
        <table className="wp-list-table widefat fixed striped table-view-list">
            <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            { pages.map( ( page ) => (
                <tr key={ page.id }>
                    <td>{ decodeEntities( page.title.rendered ) }</td>
                    <td>
                        <div className="form-buttons">
                            <EditPageButton pageId={ page.id } />
                            {/* <span aria-hidden="true" class="wp-exclude-emoji"><span aria-hidden="true" class="wp-exclude-emoji"><span aria-hidden="true" class="wp-exclude-emoji">↓</span></span></span> This is the only change in the PagesList component */}
                            <DeletePageButton pageId={ page.id }/>
                            {/* <span aria-hidden="true" class="wp-exclude-emoji"><span aria-hidden="true" class="wp-exclude-emoji"><span aria-hidden="true" class="wp-exclude-emoji">↑</span></span></span> This is the only change in the PagesList component */}
                        </div>
                    </td>
                </tr>
            ) ) }
            </tbody>
        </table>
    );
}

function Notifications() {
    const notices = useSelect(
        ( select ) => select( noticesStore ).getNotices(),
        []
    );
    const { removeNotice } = useDispatch( noticesStore );
    const snackbarNotices = notices.filter( ({ type }) => type === 'snackbar' );

    return (
        <SnackbarList
            notices={ snackbarNotices }
            className="components-editor-notices__snackbar"
            onRemove={ removeNotice }
        />
    );
}

window.addEventListener( 'load', () => {
    const container = document.querySelector( '#my-first-gutenberg-app' );
    if ( ! container ) return;

    const root = createRoot( container );
    root.render( <MyFirstApp /> );
} );

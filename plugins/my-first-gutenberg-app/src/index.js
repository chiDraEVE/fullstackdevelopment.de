import { Button, Modal, SearchControl, Spinner, TextControl} from '@wordpress/components';
import { useState, createRoot } from '@wordpress/element';
import { useSelect } from '@wordpress/data';
import { store as coreDataStore } from '@wordpress/core-data';
import { decodeEntities } from '@wordpress/html-entities';
import { EditPageForm } from "./edit";

function PageEditButton({ pageId }) {
    const [ isOpen, setOpen ] = useState( false );
    const openModal = () => setOpen( true );
    const closeModal = () => setOpen( false );
    return (
        <>
            <Button
                onClick={ openModal }
                variant="primary"
            >
                Edit
            </Button>
            { isOpen && (
                <Modal onRequestClose={ closeModal } title="Edit page">
                    <EditPageForm
                        pageId={pageId}
                        onCancel={closeModal}
                        onSaveFinished={closeModal}
                    />
                </Modal>
            ) }
        </>
    )
}

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
            <SearchControl
                value={ searchTerm }
                onChange={ setSearchTerm }
            />
            <PagesList hasResolved={ hasResolved } pages={ pages }/>
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
                        <PageEditButton pageId = { page.id } />
                    </td>
                </tr>
            ) ) }
            </tbody>
        </table>
    );
}

window.addEventListener( 'load', () => {
    const container = document.querySelector( '#my-first-gutenberg-app' );
    if ( ! container ) return;

    const root = createRoot( container );
    root.render( <MyFirstApp /> );
} );

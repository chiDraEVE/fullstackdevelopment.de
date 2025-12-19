import { useDispatch } from '@wordpress/data';
import { Button, Modal, TextControl } from '@wordpress/components';
import {useState} from "@wordpress/element";
import {PageForm} from "./PageForm";
import { store as coreDataStore } from '@wordpress/core-data';

export function CreatePageButton() {
    const [isOpen, setOpen] = useState( false );
    const openModal = () => setOpen( true );
    const closeModal = () => setOpen( false );
    return (
        <>
            <Button onClick={ openModal } variant="primary">
                Create a new Page
            </Button>
            { isOpen && (
                <Modal onRequestClose={ closeModal } title="Create a new page">
                    <CreatePageForm
                        onCancel={ closeModal }
                        onSaveFinished={ closeModal }
                    />
                </Modal>
            ) }
        </>
    );
}

export function CreatePageForm( { onCancel, onSaveFinished } ) {
    const [title, setTitle] = useState();
    const handleChange = ( title ) => setTitle( title );
    const { saveEntityRecord } = useDispatch( coreDataStore );
    const handleSave = async () => {
        const savedRecord = await saveEntityRecord(
            'postType',
            'page',
            { title, status: 'publish' }
        );
        if ( savedRecord ) {
            onSaveFinished();
        }
    };

    return (
        <PageForm
            title={ title }
            onChangeTitle={ setTitle }
            hasEdits={ !!title }
            // lastError={ lastError }
            // isSaving={ isSaving }
            onCancel={ onCancel }
            onSave={ handleSave }
        />
    );
}

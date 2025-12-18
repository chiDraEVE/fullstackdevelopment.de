import {Button, Spinner, TextControl} from "@wordpress/components";
import {useDispatch, useSelect} from "@wordpress/data";
import { store as coreDataStore } from '@wordpress/core-data';

export function EditPageForm( { pageId, onCancel, onSaveFinished } ) {
    const { isSaving, hasEdits, lastError, page } = useSelect(
        select => ({
            isSaving: select( coreDataStore ).isSavingEntityRecord( 'postType', 'page', pageId ),
            hasEdits: select( coreDataStore ).hasEditsForEntityRecord( 'postType', 'page', pageId ),
            page: select(coreDataStore).getEditedEntityRecord('postType', 'page', pageId),
            lastError: select(coreDataStore).getLastEntitySaveError('postType', 'page', pageId),
        }),[ pageId ]
    );
    const { editEntityRecord } = useDispatch( coreDataStore );
    const handleChange = ( title ) => editEntityRecord( 'postType', 'page', pageId, { title } );
    const { saveEditedEntityRecord } = useDispatch( coreDataStore );
    const handleSave = async () => {
        const updateRecord = await saveEditedEntityRecord('postType', 'page', pageId);
        if (updateRecord) {
            onSaveFinished();
        }
    }

    return (
        <>
            <div className="my-gutenberg-form">
                <TextControl
                    label="Page title:"
                    value={ page.title }
                    onChange={ handleChange }
                />
                <div className="form-buttons">
                    <Button onClick={ handleSave } variant="primary" disabled={ ! hasEdits || isSaving }>
                        { isSaving ? (
                            <>
                                <Spinner/>
                                Saving
                            </>
                        ) : 'Save' }
                    </Button>
                    <Button
                        onClick={ onCancel }
                        variant="tertiary"
                        disabled={ isSaving }
                    >
                        Cancel
                    </Button>
                </div>
            </div>
            { lastError ? (
                <div className="form-error">
                    Error: { lastError.message }
                </div>
            ) : false }
        </>
    );
}
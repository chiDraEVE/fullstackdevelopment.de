import {Button, Spinner, TextControl} from "@wordpress/components";
import {useDispatch, useSelect} from "@wordpress/data";
import { store as coreDataStore } from '@wordpress/core-data';
import {PageForm} from "./PageForm";

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
        <PageForm
            title={ page.title }
            onChangeTitle={ handleChange }
            hasEdits={ hasEdits }
            lastError={ lastError }
            isSaving={ isSaving }
            onCancel={ onCancel }
            onSave={ handleSave }
        />
    );
}
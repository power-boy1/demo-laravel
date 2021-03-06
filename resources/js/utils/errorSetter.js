export function setterErrorsFromFormFields(errors)
{
    let errorFields = {
        name: '',
        email: '',
        description: ''
    };

    const fields = {};

    for (let key in errorFields) {
        fields[key] = errors[key]? errors[key][0] : '';
    }

    return fields
}
